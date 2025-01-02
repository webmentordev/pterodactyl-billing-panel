<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Server;
use App\Models\Usage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CreatePterodactylServer extends Command
{
    protected $signature = 'app:create-pterodactyl-server {orderID}';

    protected $description = 'Create Pterodactyl Server for Order';

    public function handle()
    {
        $orderID = $this->argument('orderID');
        $order = Order::find($orderID);
        $rconPassword = $this->rconPassword();
        $url = config('app.ptero_url') . '/api/application/servers';
        $apiKey = config('app.ptero_api');
        $rustEggID = config('app.ptero_egg_id');
        $backgroundImage = config('app.url') . '/assets/rustdedicated-hosting-banner.png';
        $allowedThreads = 2;

        $selectedServer = $this->getServers($allowedThreads);

        if ($selectedServer) {
            $threads = $this->getUsage($selectedServer->id, $allowedThreads);

            $threadOne = $threads[0];
            $threadTwo = $threads[1];

            $nodeNumber = $selectedServer->node_id;
            $seed = rand(0, 2147483647);
            $maxPorts = config('app.rust_max_ports');
            $freePorts = $this->getPorts($nodeNumber, $maxPorts);

            $additionalPorts = [];
            $serverPortID = $freePorts[0]['id'];

            $serverPort = $freePorts[0]['port'];
            $queryPort = $freePorts[1]['port'];
            $appPort = $freePorts[2]['port'];
            $rconPort = $freePorts[3]['port'];

            foreach ($freePorts as $index => $port) {
                if ($index != 0) {
                    $additionalPorts[] = $port['id'];
                }
            }

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $apiKey",
            ])->post($url, [
                'name' => 'Rust Server #' . rand(9, 99999),
                'user' => $order->user->panel_user_id,
                'egg' => $rustEggID,
                "node" => $nodeNumber,
                'docker_image' => 'ghcr.io/pterodactyl/games:rust',
                'startup' => '"./RustDedicated -batchmode +server.port {{SERVER_PORT}} +server.queryport {{QUERY_PORT}} +server.identity "rust" +rcon.ip 0.0.0.0 +rcon.port {{RCON_PORT}} +rcon.web true +server.hostname \"{{HOSTNAME}}\" +server.level \"{{LEVEL}}\" +server.description \"{{DESCRIPTION}}\" +server.url \"{{SERVER_URL}}\" +server.headerimage \"{{SERVER_IMG}}\" +server.maxplayers {{MAX_PLAYERS}} +rcon.password \"{{RCON_PASS}}\" +app.port {{APP_PORT}} +server.saveinterval {{SAVEINTERVAL}} $( [ -z ${MAP_URL} ] && printf %s "+server.worldsize \"{{WORLD_SIZE}}\" +server.seed \"$( if [ -f seed.txt ] && [[ ${WORLD_SEED} == "0" ]]; then printf %s $(cat seed.txt); else printf %s ${WORLD_SEED}; fi )\""|| printf %s "+server.levelurl {{MAP_URL}}" ) {{ADDITIONAL_ARGS}}"',
                'environment' => [
                    'RCON_PORT' => $rconPort,
                    'QUERY_PORT' => $queryPort,
                    'APP_PORT' => $appPort,
                    'SRCDS_APPID' => '258550',
                    'MAX_PLAYERS' => 150,
                    'HOSTNAME' => 'RustDedicated.com Server',
                    'LEVEL' => "Procedural Map",
                    'DESCRIPTION' => "Rust Server - Powered By RustDedicated.com",
                    'WORLD_SIZE' => 3000,
                    'WORLD_SEED' => "$seed",
                    'SAVEINTERVAL' => 300,
                    'REGEN_SERVER' => 0,
                    'SERVER_IMG' => $backgroundImage,
                    'SERVER_URL' => config('app.url'),
                    'REMOVE_FILES' => "server\/rust\/player.deaths.*.db server\/rust\/player.identities.*.db server\/rust\/player.states.*.db server\/rust\/player.tokens.db proceduralmap.*.*.*.map server\/rust\/proceduralmap.*.*.*.sav oxide\/data\/Kits_Data.json oxide\/data\/NTeleportationHome.json oxide\/data\/ServerRewards\/player_data.json oxide\/data\/PTTracker\/playtime_data.json",
                    'FRAMEWORK' => 'vanilla',
                    'RCON_PASS' => $rconPassword,
                ],
                'limits' => [
                    'memory' => 15240,
                    'swap' => 5000,
                    'disk' => 30000,
                    'io' => 500,
                    'cpu' => 200,
                    'threads' => "$threadOne,$threadTwo"
                ],
                'feature_limits' => [
                    'databases' => 0,
                    'backups' => 2
                ],
                'allocation' => [
                    'default' => $serverPortID,
                    'additional' => $additionalPorts
                ],
            ]);
            if ($response->successful()) {
                Usage::create([
                    'order_id' => $order->id,
                    'server_id' => $selectedServer->id,
                    'cpu_pin_1' => $threadOne,
                    'cpu_pin_2' => $threadTwo,
                    'server_port' => $serverPort,
                    'query_port' => $queryPort,
                    'rcon_port' => $rconPort,
                    'app_port' => $appPort
                ]);
                return 1;
            } else {
                $this->error('Failed to create server: ' . $response->body());
                return 0;
            }
        } else {
            Log::error('Servers are out of stock!');
            return 0;
        }
    }

    private function rconPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwzxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 15; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    private function getPorts($node, $maxPorts)
    {
        $url = config('app.ptero_url') . '/api/application/nodes/' . $node . '/allocations';
        $apiKey = config('app.ptero_api');
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $apiKey",
        ])->get($url);
        if ($response->successful()) {
            $responseData = $response->json()['data'];
            $unassignedPorts = array_map(
                fn($allocation) => [
                    'id' => $allocation['attributes']['id'],
                    'port' => $allocation['attributes']['port'],
                ],
                array_filter(
                    $responseData,
                    fn($allocation) => $allocation['attributes']['assigned'] === false
                )
            );
            return array_slice($unassignedPorts, 0, $maxPorts);
        } else {
            return 'Failed to retrieve node: ' . $response->body();
        }
    }

    private function getServers($allowedThreads)
    {
        $servers = Server::withCount('usage')
            ->get()
            ->filter(function ($server) use ($allowedThreads) {
                $totalThreads = $server->threads;
                $maxUsageGroups = intdiv($totalThreads, $allowedThreads);
                return $server->usage_count < $maxUsageGroups;
            });
        return $servers->first();
    }

    private function getUsage($id, $threads)
    {
        $totalThreads = $threads;
        $assignedThreads = [];
        for ($index = 0; $index < $totalThreads; $index += 2) {
            $firstThread = $index;
            $secondThread = $index + 1;
            $usage = Usage::where([
                'server_id' => $id,
                'cpu_pin_1' => $firstThread,
                'cpu_pin_2' => $secondThread
            ])->first();

            if (!$usage) {
                return [$firstThread, $secondThread];
            } else {
                $assignedThreads[] = $firstThread;
                $assignedThreads[] = $secondThread;
            }
        }
        return null;
    }
}

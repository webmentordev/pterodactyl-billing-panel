<?php

namespace App\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Server;
use Livewire\Component;
use App\Models\Reminder;
use Stripe\StripeClient;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class Package extends Component
{
    public $price = 25.0, $threads = 2, $outOfStock = false, $email;

    public function mount()
    {
        SEOMeta::setTitle('Rent Budget Rust Server for $25');
        SEOMeta::setDescription('Purchase a dedicated Rust server for just $25, featuring 60GB NVMe storage, 15GB DDR4 RAM, a 2-thread CPU, and unlimited player slots.');

        OpenGraph::setDescription('Purchase a dedicated Rust server for just $25, featuring 60GB NVMe storage, 15GB DDR4 RAM, a 2-thread CPU, and unlimited player slots.');
        OpenGraph::setTitle('Rent Budget Rust Server for $25');

        JsonLd::setTitle('Rent Budget Rust Server for $25');
        JsonLd::setDescription('Purchase a dedicated Rust server for just $25, featuring 60GB NVMe storage, 15GB DDR4 RAM, a 2-thread CPU, and unlimited player slots.');

        $this->price = config('app.price');
        $server = $this->getServers($this->threads);
        if (!$server) {
            $this->outOfStock = true;
        }
    }

    #[Layout('layouts.livewire.guest')]
    public function render()
    {
        return view('livewire.package');
    }

    public function buyNow()
    {
        if ($this->throttle()) {
            return session()->flash('failed', 'Please complete your previous order! visit the client area.');
        }

        $this->tebexCheckout();
    }

    private function tebexCheckout()
    {
        if ($this->outOfStock) {
            return;
        }
        if (!Auth::check()) {
            return $this->redirect('/login');
        }

        $tebexUser = config('app.tebex_user');
        $tebexPrivate =  config('app.tebex_private');

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'price' => number_format($this->price)
        ]);

        $completeURL = URL::temporarySignedRoute(
            'order.success',
            now()->addHours(3),
            ['order' => $order->id]
        );

        $returnURL = URL::temporarySignedRoute(
            'order.cancel',
            now()->addHours(3),
            ['order' => $order->id]
        );

        $data = [
            'basket' => [
                'first_name' => Auth::user()->name,
                'last_name' => 'User',
                'email' => Auth::user()->email,
                'return_url' => $returnURL,
                'complete_url' => $completeURL,
                'expires_at' => Carbon::now()->addHours(3)->toIso8601String(),
                'custom' => [
                    'order_id' => $order->id
                ]
            ],
            'items' => [
                [
                    'package' => [
                        'price' => 25.00,
                        'name' => 'Rust Game Server'
                    ]
                ],
            ],
        ];

        $response = Http::withBasicAuth($tebexUser, $tebexPrivate)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post('https://checkout.tebex.io/api/checkout', $data);

        if ($response->successful()) {
            $result = $response->json();
            $url = $result['links']['checkout'];
            $order->gateway_order_id = $result['ident'];
            $order->gateway = 'tebex';
            $order->checkout_url = $url;
            $order->save();
            return redirect($url);
        } else {
            Http::post(config('app.discord_exception'), [
                'content' => "```" .  $response->body() . "```",
            ]);
            return abort(500);
        }
    }

    private function getServers($allowedThreads)
    {
        $servers = Server::withCount('usage')->where('is_active', true)
            ->get()
            ->filter(function ($server) use ($allowedThreads) {
                $totalThreads = $server->threads_limit;
                $maxUsageGroups = intdiv($totalThreads, $allowedThreads);
                return $server->usage_count < $maxUsageGroups;
            });
        return $servers->first();
    }

    public function request()
    {
        $this->validate([
            'email' => ['required', 'email', 'max:255', 'unique:reminders,email'],
        ], [
            'email.unique' => 'The email address already exists in our system. We will use it to notify you.',
        ]);
        Reminder::create(['email' => $this->email]);
        return session()->flash('success', 'Your request has been submitted!');
    }

    private function throttle()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 'pending')->get();
        if (count($order)) {
            return true;
        } else {
            return false;
        }
    }
}

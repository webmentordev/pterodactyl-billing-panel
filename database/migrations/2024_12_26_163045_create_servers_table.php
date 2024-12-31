<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('processor');
            $table->string('ip');
            $table->string('domain');
            $table->bigInteger('cores');
            $table->bigInteger('threads');
            $table->bigInteger('swap');
            $table->bigInteger('ram');
            $table->string('ram_type');
            $table->bigInteger('storage');
            $table->string('storage_type');
            $table->string('location');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usages', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('server_id')->constrained()->onDelete('cascade');
            $table->integer('cpu_pin_1');
            $table->integer('cpu_pin_2');
            $table->integer('ram');
            $table->integer('storage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usages');
    }
};

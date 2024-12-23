<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('stripe_id');
            $table->string('image');
            $table->decimal('price', 10, 2);
            $table->text('body');
            $table->integer('players');
            $table->integer('storage');
            $table->string('storage_type');
            $table->integer('cores');
            $table->integer('ram');
            $table->string('ram_type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('stripe_order_id')->nullable();
            $table->boolean('has_paid')->default(false);
            $table->string('status')->default('pending');
            $table->text('checkout_url')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->text('total_payments')->default(0);
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

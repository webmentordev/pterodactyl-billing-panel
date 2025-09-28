<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trials', function (Blueprint $table) {
            $table->boolean('will_delete')->nullable()->default(false);
            $table->boolean('viewed_email')->nullable()->default(false);
            $table->string('user_agent')->nullable();
            $table->string('token')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('trials', function (Blueprint $table) {
            $table->dropColumn(['will_delete'. 'viewed_email', 'user_agent', 'token']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('type')->index(); // 'cart_add', 'wishlist_add', 'view'
            $table->string('user_session')->nullable(); // For anonymous users
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // For logged users
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->json('additional_data')->nullable(); // For extra tracking data
            $table->timestamps();
            
            // Index for performance
            $table->index(['product_id', 'type', 'created_at']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_interactions');
    }
};

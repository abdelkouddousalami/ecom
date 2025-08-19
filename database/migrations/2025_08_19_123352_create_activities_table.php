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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'order_created', 'product_added', 'inventory_updated', etc.
            $table->string('title'); // Human readable title
            $table->text('description'); // Description of the activity
            $table->string('icon_type')->default('blue'); // blue, green, purple, orange, red
            $table->unsignedBigInteger('related_id')->nullable(); // ID of related model (order_id, product_id, etc.)
            $table->string('related_type')->nullable(); // Class name of related model
            $table->json('metadata')->nullable(); // Additional data
            $table->timestamps();
            
            $table->index(['type', 'created_at']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};

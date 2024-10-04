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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id(); // Unique identifier for each favorite entry
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Reference to the user
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Reference to the product
            $table->timestamps(); // Created at and updated at timestamps

            // Ensure a user can favorite the same product only once
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Product ID
            $table->unsignedBigInteger('artisan_id'); // Artisan who uploaded the product
            $table->string('name'); // Product name
            $table->text('description'); // Product description
            $table->decimal('price', 10, 2); // Product price
            $table->string('image'); // Image path
            $table->string('category'); // Product category (e.g., Jewelry, Woodwork)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Approval status
            $table->timestamps(); // created_at and updated_at
        
            $table->foreign('artisan_id')->references('id')->on('users')->onDelete('cascade'); // Artisan reference
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

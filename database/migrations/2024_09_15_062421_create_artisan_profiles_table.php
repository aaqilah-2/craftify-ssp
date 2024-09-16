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
        Schema::create('artisan_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('street_address');
            $table->string('city');
            $table->string('postal_code');
            $table->integer('years_of_experience');
            $table->text('skills');
            $table->text('bio');
            $table->json('social_media_links')->nullable();
            $table->string('logo'); // Artisan logo or profile photo
            $table->string('contact_number');
            $table->decimal('service_radius_km', 8, 2)->nullable(); // In kilometers
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisan_profiles');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->string('profile_photo')->nullable();
            $table->string('name'); // User's name
            $table->string('username'); // Unique username
            $table->string('role')->nullable(); // Role of the user
            $table->text('text'); // Testimonial text
            $table->string('metric')->nullable(); // Optional metric
            $table->boolean('is_public')->default(true); // Visibility
            $table->timestamps(); // Created and updated timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name_en');
            $table->string('client_name_ar')->nullable();
            $table->string('client_position_en')->nullable();
            $table->string('client_position_ar')->nullable();
            $table->string('client_company')->nullable();
            $table->string('client_image')->nullable();
            $table->text('review_en');
            $table->text('review_ar')->nullable();
            $table->tinyInteger('rating')->default(5); // 1-5 stars
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

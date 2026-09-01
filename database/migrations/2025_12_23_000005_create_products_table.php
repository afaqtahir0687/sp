<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
   {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')
                  ->nullable()
                  ->constrained('sub_categories')
                  ->onDelete('set null');

            // Basic info
            $table->text('name');
            $table->text('slug');
            $table->string('sku')->nullable();

            // Descriptions
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('size_guide')->nullable();
            $table->longText('additional_info')->nullable();

            // Pricing
            $table->decimal('price', 10, 2);
            $table->json('quantities')->nullable();
            $table->boolean('allow_custom_quantity')->default(true);
            $table->boolean('allow_round_corners')->default(false);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('flexible_rate', 10, 2)->nullable();
            $table->decimal('urgent_rate', 10, 2)->nullable();

            // Production & delivery
            $table->integer('delivery_days')->default(1);
            $table->integer('production_days')->default(3);
            $table->integer('flexible_production_days')->default(5);
            $table->integer('urgent_production_days')->default(1);

            // Media
            $table->string('image')->nullable();
            $table->json('images')->nullable();

            // Product options (Printing related)
            $table->json('materials')->nullable();
            $table->json('materials_ar')->nullable();
            $table->json('sizes')->nullable();
            $table->json('sizes_ar')->nullable();
            $table->json('side_1_colors')->nullable();
            $table->json('side_1_colors_ar')->nullable();
            $table->json('sides_options')->nullable();
            $table->json('sides_options_ar')->nullable();
            $table->json('lamination_types')->nullable();
            $table->json('lamination_types_ar')->nullable();
            $table->json('die_cutting_options')->nullable();
            $table->json('die_cutting_options_ar')->nullable();

            // Flags
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new_arrival')->default(false);
            $table->boolean('is_wishlist')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

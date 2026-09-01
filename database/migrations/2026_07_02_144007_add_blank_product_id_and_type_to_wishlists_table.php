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
        Schema::table('wishlists', function (Blueprint $table) {
            // Make product_id nullable first
            $table->dropForeign(['product_id']);
            $table->foreignId('product_id')->nullable()->change();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            // Add blank_product_id and type
            $table->unsignedBigInteger('blank_product_id')->nullable()->after('product_id');
            $table->string('type')->default('product')->after('blank_product_id');

            // Add foreign key for blank_product_id
            $table->foreign('blank_product_id')
                  ->references('id')
                  ->on('blank_products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wishlists', function (Blueprint $table) {
            // Uncomment if you created the foreign key above.
            // $table->dropForeign(['blank_product_id']);

            $table->dropColumn(['blank_product_id', 'type']);
        });
    }
};
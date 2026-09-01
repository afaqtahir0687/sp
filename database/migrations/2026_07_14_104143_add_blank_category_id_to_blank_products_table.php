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
        Schema::table('blank_products', function (Blueprint $table) {
            $table->foreignId('blank_category_id')
                ->nullable()
                ->after('id')
                ->constrained('blank_categories')
                ->nullOnDelete();

            $table->foreignId('blank_subcategory_id')
                ->nullable()
                ->after('blank_category_id')
                ->constrained('blank_sub_categories')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blank_products', function (Blueprint $table) {
            $table->dropForeign(['blank_category_id']);
            $table->dropForeign(['blank_subcategory_id']);
            $table->dropColumn([
                'blank_category_id',
                'blank_subcategory_id',
            ]);
        });
    }
};
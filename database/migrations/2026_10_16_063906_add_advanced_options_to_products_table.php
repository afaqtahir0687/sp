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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'material_prices')) {
                $table->json('material_prices')->nullable()->after('materials_ar');
            }
            if (!Schema::hasColumn('products', 'orientations')) {
                $table->json('orientations')->nullable()->after('die_cutting_options_ar');
            }
            if (!Schema::hasColumn('products', 'orientations_ar')) {
                $table->json('orientations_ar')->nullable()->after('orientations');
            }
            if (!Schema::hasColumn('products', 'folding_options')) {
                $table->json('folding_options')->nullable()->after('orientations_ar');
            }
            if (!Schema::hasColumn('products', 'folding_options_ar')) {
                $table->json('folding_options_ar')->nullable()->after('folding_options');
            }
            if (!Schema::hasColumn('products', 'binding_options')) {
                $table->json('binding_options')->nullable()->after('folding_options_ar');
            }
            if (!Schema::hasColumn('products', 'binding_options_ar')) {
                $table->json('binding_options_ar')->nullable()->after('binding_options');
            }
            if (!Schema::hasColumn('products', 'lamination_price')) {
                $table->decimal('lamination_price', 10, 2)->nullable()->default(0)->after('lamination_types_ar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'material_prices',
                'orientations',
                'orientations_ar',
                'folding_options',
                'folding_options_ar',
                'binding_options',
                'binding_options_ar',
                'lamination_price',
            ]);
        });
    }
};

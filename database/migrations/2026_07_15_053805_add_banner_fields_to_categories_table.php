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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('status');
            $table->string('banner_top_text_en')->nullable()->after('banner_image');
            $table->string('banner_top_text_ar')->nullable()->after('banner_top_text_en');
            $table->string('banner_discount_text_en')->nullable()->after('banner_top_text_ar');
            $table->string('banner_discount_text_ar')->nullable()->after('banner_discount_text_en');
            $table->string('banner_bottom_text_en')->nullable()->after('banner_discount_text_ar');
            $table->string('banner_bottom_text_ar')->nullable()->after('banner_bottom_text_en');
            $table->string('banner_button_text_en')->nullable()->after('banner_bottom_text_ar');
            $table->string('banner_button_text_ar')->nullable()->after('banner_button_text_en');
            $table->string('banner_button_link')->nullable()->after('banner_button_text_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'banner_image',
                'banner_top_text_en',
                'banner_top_text_ar',
                'banner_discount_text_en',
                'banner_discount_text_ar',
                'banner_bottom_text_en',
                'banner_bottom_text_ar',
                'banner_button_text_en',
                'banner_button_text_ar',
                'banner_button_link'
            ]);
        });
    }
};

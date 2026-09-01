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
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('banner_title_en')->nullable()->after('banner_image');
            $table->string('banner_title_ar')->nullable()->after('banner_title_en');
            $table->string('banner_button_text_en')->nullable()->after('banner_title_ar');
            $table->string('banner_button_text_ar')->nullable()->after('banner_button_text_en');
            $table->string('banner_button_link')->nullable()->after('banner_button_text_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn([
                'banner_title_en',
                'banner_title_ar',
                'banner_button_text_en',
                'banner_button_text_ar',
                'banner_button_link'
            ]);
        });
    }
};

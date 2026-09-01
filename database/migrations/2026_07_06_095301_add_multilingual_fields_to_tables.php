<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Categories
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (Schema::hasColumn('categories', 'name') && !Schema::hasColumn('categories', 'name_en')) {
                    $table->renameColumn('name', 'name_en');
                }
            });
            Schema::table('categories', function (Blueprint $table) {
                if (!Schema::hasColumn('categories', 'name_ar')) {
                    $table->string('name_ar')->nullable();
                }
            });
        }

        // 2. SubCategories
        if (Schema::hasTable('sub_categories')) {
            Schema::table('sub_categories', function (Blueprint $table) {
                if (Schema::hasColumn('sub_categories', 'name') && !Schema::hasColumn('sub_categories', 'name_en')) {
                    $table->renameColumn('name', 'name_en');
                }
            });
            Schema::table('sub_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('sub_categories', 'name_ar')) {
                    $table->string('name_ar')->nullable();
                }
            });
        }

        // 3. Products
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                if (Schema::hasColumn('products', 'name') && !Schema::hasColumn('products', 'name_en')) {
                    $table->renameColumn('name', 'name_en');
                }
                if (Schema::hasColumn('products', 'short_description') && !Schema::hasColumn('products', 'short_description_en')) {
                    $table->renameColumn('short_description', 'short_description_en');
                }
                if (Schema::hasColumn('products', 'description') && !Schema::hasColumn('products', 'description_en')) {
                    $table->renameColumn('description', 'description_en');
                }
                if (Schema::hasColumn('products', 'size_guide') && !Schema::hasColumn('products', 'size_guide_en')) {
                    $table->renameColumn('size_guide', 'size_guide_en');
                }
                if (Schema::hasColumn('products', 'additional_info') && !Schema::hasColumn('products', 'additional_info_en')) {
                    $table->renameColumn('additional_info', 'additional_info_en');
                }
            });
            Schema::table('products', function (Blueprint $table) {
                if (!Schema::hasColumn('products', 'name_ar')) {
                    $table->text('name_ar')->nullable();
                }
                if (!Schema::hasColumn('products', 'short_description_ar')) {
                    $table->text('short_description_ar')->nullable();
                }
                if (!Schema::hasColumn('products', 'description_ar')) {
                    $table->longText('description_ar')->nullable();
                }
                if (!Schema::hasColumn('products', 'size_guide_ar')) {
                    $table->longText('size_guide_ar')->nullable();
                }
                if (!Schema::hasColumn('products', 'additional_info_ar')) {
                    $table->longText('additional_info_ar')->nullable();
                }
            });
        }

        // 4. Blank Products
        if (Schema::hasTable('blank_products')) {
            Schema::table('blank_products', function (Blueprint $table) {
                if (Schema::hasColumn('blank_products', 'name') && !Schema::hasColumn('blank_products', 'name_en')) {
                    $table->renameColumn('name', 'name_en');
                }
                if (Schema::hasColumn('blank_products', 'short_description') && !Schema::hasColumn('blank_products', 'short_description_en')) {
                    $table->renameColumn('short_description', 'short_description_en');
                }
                if (Schema::hasColumn('blank_products', 'description') && !Schema::hasColumn('blank_products', 'description_en')) {
                    $table->renameColumn('description', 'description_en');
                }
            });
            Schema::table('blank_products', function (Blueprint $table) {
                if (!Schema::hasColumn('blank_products', 'name_ar')) {
                    $table->string('name_ar')->nullable();
                }
                if (!Schema::hasColumn('blank_products', 'short_description_ar')) {
                    $table->text('short_description_ar')->nullable();
                }
                if (!Schema::hasColumn('blank_products', 'description_ar')) {
                    $table->longText('description_ar')->nullable();
                }
            });
        }

        // 5. Services
        if (Schema::hasTable('services')) {
            Schema::table('services', function (Blueprint $table) {
                if (Schema::hasColumn('services', 'title') && !Schema::hasColumn('services', 'title_en')) {
                    $table->renameColumn('title', 'title_en');
                }
                if (Schema::hasColumn('services', 'description') && !Schema::hasColumn('services', 'description_en')) {
                    $table->renameColumn('description', 'description_en');
                }
            });
            Schema::table('services', function (Blueprint $table) {
                if (!Schema::hasColumn('services', 'title_ar')) {
                    $table->string('title_ar')->nullable();
                }
                if (!Schema::hasColumn('services', 'description_ar')) {
                    $table->text('description_ar')->nullable();
                }
            });
        }

        // 6. Sliders
        if (Schema::hasTable('sliders')) {
            Schema::table('sliders', function (Blueprint $table) {
                if (Schema::hasColumn('sliders', 'title') && !Schema::hasColumn('sliders', 'title_en')) {
                    $table->renameColumn('title', 'title_en');
                }
                if (Schema::hasColumn('sliders', 'subtitle') && !Schema::hasColumn('sliders', 'subtitle_en')) {
                    $table->renameColumn('subtitle', 'subtitle_en');
                }
            });
            Schema::table('sliders', function (Blueprint $table) {
                if (!Schema::hasColumn('sliders', 'title_ar')) {
                    $table->string('title_ar')->nullable();
                }
                if (!Schema::hasColumn('sliders', 'subtitle_ar')) {
                    $table->string('subtitle_ar')->nullable();
                }
            });
        }

        // 7. Banners
        if (Schema::hasTable('banners')) {
            Schema::table('banners', function (Blueprint $table) {
                if (Schema::hasColumn('banners', 'title') && !Schema::hasColumn('banners', 'title_en')) {
                    $table->renameColumn('title', 'title_en');
                }
                if (Schema::hasColumn('banners', 'subtitle') && !Schema::hasColumn('banners', 'subtitle_en')) {
                    $table->renameColumn('subtitle', 'subtitle_en');
                }
                if (Schema::hasColumn('banners', 'button_text') && !Schema::hasColumn('banners', 'button_text_en')) {
                    $table->renameColumn('button_text', 'button_text_en');
                }
            });
            Schema::table('banners', function (Blueprint $table) {
                if (!Schema::hasColumn('banners', 'title_ar')) {
                    $table->string('title_ar')->nullable();
                }
                if (!Schema::hasColumn('banners', 'subtitle_ar')) {
                    $table->string('subtitle_ar')->nullable();
                }
                if (!Schema::hasColumn('banners', 'button_text_ar')) {
                    $table->string('button_text_ar')->nullable();
                }
            });
        }

        // 8. Faqs
        if (Schema::hasTable('faqs')) {
            Schema::table('faqs', function (Blueprint $table) {
                if (Schema::hasColumn('faqs', 'question') && !Schema::hasColumn('faqs', 'question_en')) {
                    $table->renameColumn('question', 'question_en');
                }
                if (Schema::hasColumn('faqs', 'answer') && !Schema::hasColumn('faqs', 'answer_en')) {
                    $table->renameColumn('answer', 'answer_en');
                }
            });
            Schema::table('faqs', function (Blueprint $table) {
                if (!Schema::hasColumn('faqs', 'question_ar')) {
                    $table->string('question_ar')->nullable();
                }
                if (!Schema::hasColumn('faqs', 'answer_ar')) {
                    $table->text('answer_ar')->nullable();
                }
            });
        }

        // 9. Portfolios
        if (Schema::hasTable('portfolios')) {
            Schema::table('portfolios', function (Blueprint $table) {
                if (Schema::hasColumn('portfolios', 'title') && !Schema::hasColumn('portfolios', 'title_en')) {
                    $table->renameColumn('title', 'title_en');
                }
                if (Schema::hasColumn('portfolios', 'description') && !Schema::hasColumn('portfolios', 'description_en')) {
                    $table->renameColumn('description', 'description_en');
                }
            });
            Schema::table('portfolios', function (Blueprint $table) {
                if (!Schema::hasColumn('portfolios', 'title_ar')) {
                    $table->string('title_ar')->nullable();
                }
                if (!Schema::hasColumn('portfolios', 'description_ar')) {
                    $table->text('description_ar')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};

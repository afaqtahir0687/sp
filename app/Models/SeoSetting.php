<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'page_name',
        'title',
        'meta_keywords',
        'meta_description',
    ];

    /**
     * Pre-defined list of common frontend pages with user-friendly names.
     */
    public static function pageLabels(): array
    {
        return [
            'home' => 'Home Page',
            'about.index' => 'About Us',
            'contact.index' => 'Contact Us',
            'products.index' => 'Products Catalog',
            'services.page' => 'Services',
            'vision.mission' => 'Vision & Mission',
            'request.visit' => 'Request Sales Visit',
            'track.order' => 'Track Order',
            'cart.index' => 'Shopping Cart',
            'checkout.index' => 'Checkout',
            'faqs.page' => 'FAQs',
            'books.index' => 'Books',
            'blank.products.index' => 'Blank Products',
            'blogs.index' => 'Blog & News',
            'default' => 'Default (Global Fallback)',
        ];
    }

    /**
     * Get user-friendly page name.
     */
    public function getDisplayPageNameAttribute(): string
    {
        $labels = self::pageLabels();
        return $labels[$this->page_name] ?? ucwords(str_replace(['.', '-', '_'], ' ', $this->page_name));
    }
}

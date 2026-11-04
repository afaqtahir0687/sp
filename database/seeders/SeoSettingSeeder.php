<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoSetting;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'home',
                'title' => 'New Sign Advertising | Best Printing & Signage Agency in Riyadh',
                'meta_keywords' => 'advertising, printing, signage, business cards, banners, branding, riyadh, saudi arabia',
                'meta_description' => 'New Sign Advertising provides professional digital printing, indoor & outdoor signage, corporate gifts, business stationery, and branding solutions in Riyadh, Saudi Arabia.',
            ],
            [
                'page_name' => 'about.index',
                'title' => 'About Us | New Sign Advertising',
                'meta_keywords' => 'about new sign, printing company riyadh, advertising agency saudi arabia',
                'meta_description' => 'Learn more about New Sign Advertising, our mission, vision, and high-quality printing and signage services in Saudi Arabia.',
            ],
            [
                'page_name' => 'contact.index',
                'title' => 'Contact Us | New Sign Advertising',
                'meta_keywords' => 'contact new sign, printing inquiry riyadh, advertising company phone number',
                'meta_description' => 'Get in touch with New Sign Advertising in Riyadh, Saudi Arabia. Call us or send an inquiry for all your printing and advertising requirements.',
            ],
            [
                'page_name' => 'products.index',
                'title' => 'Our Products | New Sign Advertising',
                'meta_keywords' => 'printing products, business cards, stationery, flyers, brochures, packaging boxes',
                'meta_description' => 'Explore our wide range of custom printing products including business stationery, promotional items, packaging, and marketing materials.',
            ],
            [
                'page_name' => 'services.page',
                'title' => 'Our Services | New Sign Advertising',
                'meta_keywords' => 'printing services, signage fabrication, event branding, digital printing riyadh',
                'meta_description' => 'Discover our end-to-end advertising services: large format printing, offset printing, corporate branding, exhibition stands, and laser cutting.',
            ],
            [
                'page_name' => 'vision.mission',
                'title' => 'Vision & Mission | New Sign Advertising',
                'meta_keywords' => 'company vision, mission, printing values, advertising excellence',
                'meta_description' => 'Read about New Sign Advertising vision to lead the signage and advertising industry in Saudi Arabia with superior quality and innovation.',
            ],
            [
                'page_name' => 'request.visit',
                'title' => 'Request a Sales Visit | New Sign Advertising',
                'meta_keywords' => 'request sales visit, printing consultation riyadh, signage quotation',
                'meta_description' => 'Schedule a visit from our sales team in Riyadh to discuss your business printing, corporate gifts, and signage requirements.',
            ],
            [
                'page_name' => 'track.order',
                'title' => 'Track Your Order | New Sign Advertising',
                'meta_keywords' => 'track order, printing order status, new sign delivery tracking',
                'meta_description' => 'Track the current status and delivery progress of your printing orders with New Sign Advertising.',
            ],
            [
                'page_name' => 'cart.index',
                'title' => 'Shopping Cart | New Sign Advertising',
                'meta_keywords' => 'cart, checkout, printing order',
                'meta_description' => 'Review the items in your shopping cart and proceed to secure checkout.',
            ],
            [
                'page_name' => 'checkout.index',
                'title' => 'Checkout | New Sign Advertising',
                'meta_keywords' => 'checkout, payment, printing order confirmation',
                'meta_description' => 'Complete your order with secure payment and convenient delivery options across Saudi Arabia.',
            ],
            [
                'page_name' => 'faqs.page',
                'title' => 'Frequently Asked Questions (FAQs) | New Sign Advertising',
                'meta_keywords' => 'printing faqs, order questions, file preparation, delivery questions',
                'meta_description' => 'Find answers to commonly asked questions about ordering, print specifications, delivery, and payments.',
            ],
            [
                'page_name' => 'books.index',
                'title' => 'Books Printing & Publishing | New Sign Advertising',
                'meta_keywords' => 'book printing, magazine printing, booklet binding, publishing riyadh',
                'meta_description' => 'High quality book printing and binding services in Riyadh, from paperbacks to hardcover publications.',
            ],
            [
                'page_name' => 'blank.products.index',
                'title' => 'Blank Products | New Sign Advertising',
                'meta_keywords' => 'blank t-shirts, plain mugs, blank promotional products, custom printing blanks',
                'meta_description' => 'Browse our selection of blank promotional products ready for custom printing and embroidery.',
            ],
            [
                'page_name' => 'blogs.index',
                'title' => 'Blog & Printing Insights | New Sign Advertising',
                'meta_keywords' => 'printing blog, advertising tips, branding guides, design insights',
                'meta_description' => 'Read the latest news, branding tips, design trends, and printing insights from New Sign Advertising.',
            ],
            [
                'page_name' => 'default',
                'title' => 'New Sign Advertising | Advertising Agency | Riyadh, Saudi Arabia',
                'meta_keywords' => 'printing, advertising, signage, branding, riyadh, saudi arabia',
                'meta_description' => 'New Sign Advertising provides premier digital printing, signage fabrication, promotional gifts, and corporate branding services in Riyadh, Saudi Arabia.',
            ],
        ];

        foreach ($pages as $page) {
            SeoSetting::updateOrCreate(
                ['page_name' => $page['page_name']],
                $page
            );
        }
    }
}


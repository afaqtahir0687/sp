<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if (file_exists(app_path('helper.php'))) {
            require_once app_path('helper.php');
        }

        // Custom translation directive that uses JSON files
        Blade::directive('__', function ($expression) {
            return "<?php echo \App\Helpers\Translation::get($expression); ?>";
        });

        View::composer('frontend.layouts.header', function ($view) {
            $headerCategories = Category::where('status', 'active')
                ->with(['subcategories' => function ($query) {
                    $query->where('status', 'active')
                        ->with(['products' => function ($q) {
                            $q->where('status', 'active')->take(6);
                        }]);
                }])
                ->get();

            $view->with('headerCategories', $headerCategories);
        });

        View::composer('admin.layouts.navbar', function ($view) {
            try {
                $navOrdersCount = \App\Models\Order::whereIn('order_status', ['pending', 'processing'])->count();
                $navUnreadMessages = \App\Models\ContactMessage::where('is_read', 0)->count();
            } catch (\Exception $e) {
                $navOrdersCount = 0;
                $navUnreadMessages = 0;
            }
            $view->with([
                'navOrdersCount'    => $navOrdersCount,
                'navUnreadMessages' => $navUnreadMessages,
            ]);
        });

    }
}

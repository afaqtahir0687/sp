<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\SubCategory;
class DashboardController extends Controller
{
   
    public function index()
    {
        $data = [
            'categoriesCount' => Category::count(),
            'subcategoriesCount' => SubCategory::count(),
            'productsCount' => Product::count(),
            'ordersCount' => Order::count(),
            'usersCount' => User::count(),
            'cartsCount' => Cart::count(),
            'recentOrders' => Order::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View|Factory|Application
    {
        // this is egar loading
        $products = Product::with('category')->active()
//            ->latest()
            ->limit(8)
            ->get(); // limit == take
        return view('front.home', compact('products'));
    }
}

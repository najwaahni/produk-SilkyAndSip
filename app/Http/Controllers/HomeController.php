<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featuredProducts = Product::where('is_featured', true)->get();
        $allProducts = Product::all();
        $addons = Addon::where('is_active', true)->get();

        return view('pages.home', compact('categories', 'featuredProducts', 'allProducts', 'addons'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->query('category');
        $search = $request->query('q');

        $query = Product::with('category');

        if ($categorySlug && $categorySlug !== 'all') {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        $products = $query->get();
        $categories = Category::withCount('products')->get();
        $addons = Addon::where('is_active', true)->get();

        return view('pages.shop', compact('products', 'categories', 'addons', 'categorySlug', 'search'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        $addons = Addon::where('is_active', true)->get();
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(3)
            ->get();

        return view('pages.product-detail', compact('product', 'addons', 'relatedProducts'));
    }
}


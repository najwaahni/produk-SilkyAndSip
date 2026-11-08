<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Addon;
use Illuminate\Http\Request;

class AiAssistantController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $bundle = Product::where('slug', 'bundling-package')->first();

        return view('pages.ai-assistant', compact('products', 'bundle'));
    }

    public function chat(Request $request)
    {
        $message = strtolower(trim($request->input('message', '')));
        $sweetness = $request->input('sweetness', 'Regular');
        $coffee = $request->input('coffee', 'Balanced');
        $budget = (int) $request->input('budget', 30000);

        // Fetch the 3 official products
        $pudding = Product::where('slug', 'silky-pudding-caramel')->first();
        $dalgona = Product::where('slug', 'coffee-dalgona')->first();
        $bundle = Product::where('slug', 'bundling-package')->first();

        $reply = "";
        $recommendedProducts = [];

        if (str_contains($message, 'sweet') || str_contains($message, 'manis') || str_contains($message, 'creamy') || str_contains($message, 'pudding')) {
            $reply = "Berdasarkan selera Anda yang menyukai sensasi manis dan lembut di lidah, rekomendasi nomor satu kami adalah **Silky Pudding Caramel**! Puding vanilla Madagascar dengan saus caramel panggang gurih keemasan.";
            $recommendedProducts[] = $pudding;
            if ($bundle && $budget >= 25000) {
                $reply .= " Jika ingin sekalian menikmati kopi dalgona, **Bundling Package** adalah pilihan paling hemat.";
                $recommendedProducts[] = $bundle;
            }
        } elseif (str_contains($message, 'kopi') || str_contains($message, 'coffee') || str_contains($message, 'espresso') || str_contains($message, 'bold') || str_contains($message, 'pahit') || str_contains($message, 'melek')) {
            $reply = "Untuk pencinta kopi dengan whipped foam tebal di atas susu dingin segar, **Coffee Dalgona** adalah pilihan sempurna! Dibuat dengan busa kopi Arabica pekat yang creamy.";
            $recommendedProducts[] = $dalgona;
            if ($bundle) {
                $recommendedProducts[] = $bundle;
            }
        } elseif (str_contains($message, 'bundle') || str_contains($message, 'paket') || str_contains($message, 'hemat') || str_contains($message, 'promo') || str_contains($message, 'berdua')) {
            $reply = "Pilihan paling hemat dan favorit kami adalah **Bundling Package** (Hemat Rp 2.000)! Anda mendapatkan 1x Silky Pudding Caramel + 1x Coffee Dalgona hanya Rp 25.000.";
            $recommendedProducts[] = $bundle;
        } else {
            $reply = "Halo! Menu eksklusif kami terdiri dari **Silky Pudding Caramel**, **Coffee Dalgona**, dan **Bundling Package** hemat. Beritahu kami apa yang sedang Anda inginkan!";
            $recommendedProducts[] = $pudding;
            $recommendedProducts[] = $dalgona;
            $recommendedProducts[] = $bundle;
        }

        return response()->json([
            'reply' => $reply,
            'products' => array_map(function($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'price' => $p->price,
                    'formatted_price' => $p->formatted_price,
                    'image' => $p->image,
                    'short_description' => $p->short_description ?? substr($p->description, 0, 70) . '...',
                    'rating' => $p->rating,
                ];
            }, array_filter($recommendedProducts)),
        ]);
    }
}

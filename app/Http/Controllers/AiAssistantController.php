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
        $bundle = Product::where('slug', 'morning-indulgence-bundle')->first();

        return view('pages.ai-assistant', compact('products', 'bundle'));
    }

    public function chat(Request $request)
    {
        $message = strtolower(trim($request->input('message', '')));
        $sweetness = $request->input('sweetness', 'regular');
        $coffee = $request->input('coffee', 'balanced');
        $budget = (int) $request->input('budget', 30000);

        // Fetch products to reference in AI responses
        $pudding = Product::where('slug', 'silky-pudding-caramel')->first();
        $dalgona = Product::where('slug', 'coffee-dalgona')->first();
        $bundle = Product::where('slug', 'morning-indulgence-bundle')->first();
        $choco = Product::where('slug', 'belgian-chocolate-silky-pudding')->first();
        $honeyDalgona = Product::where('slug', 'honey-dalgona-cloud-brew')->first();

        $reply = "";
        $recommendedProducts = [];

        if (str_contains($message, 'sweet') || str_contains($message, 'manis') || str_contains($message, 'creamy') || str_contains($message, 'pudding')) {
            $reply = "Berdasarkan selera Anda yang menyukai rasa manis, creamy, dan lembut di lidah, rekomendasi terbaik kami adalah **Silky Pudding Caramel**! Puding custard dengan vanilla Madagascar asli dan lelehan saus karamel panggang keemasan.";
            $recommendedProducts[] = $pudding;
            if ($bundle && $budget >= 23000) {
                $reply .= " Jika ingin pairing yang seimbang, coba juga **Morning Indulgence Bundle** untuk paduan sempurna bersama Coffee Dalgona.";
                $recommendedProducts[] = $bundle;
            }
        } elseif (str_contains($message, 'kopi') || str_contains($message, 'coffee') || str_contains($message, 'espresso') || str_contains($message, 'bold') || str_contains($message, 'pahit') || str_contains($message, 'melek')) {
            $reply = "Untuk pencinta kopi dengan sensasi whipped foam yang padat dan creamy, **Coffee Dalgona Signature** adalah pilihan paling tepat! Dibuat dari espresso Arabica pilihan yang dikocok hingga menjadi busa lembut di atas susu dingin segar.";
            $recommendedProducts[] = $dalgona;
            if ($honeyDalgona) {
                $recommendedProducts[] = $honeyDalgona;
            }
        } elseif (str_contains($message, 'bundle') || str_contains($message, 'paket') || str_contains($message, 'hemat') || str_contains($message, 'promo') || str_contains($message, 'berdua')) {
            $reply = "Pilihan paling hemat dan favorit kami adalah **Morning Indulgence Bundle**! Anda mendapatkan 1x Silky Pudding Caramel + 1x Coffee Dalgona Signature hanya dengan Rp 23.000 (hemat Rp 4.000 dari harga normal).";
            $recommendedProducts[] = $bundle;
        } elseif (str_contains($message, 'honey') || str_contains($message, 'madu') || str_contains($message, 'floral')) {
            $reply = "Kombinasi madu hutan murni sangat istimewa! Kami merekomendasikan **Honey Dalgona Cloud Brew** dengan taburan honeycomb toffee dan drizzle madu organik alami.";
            $recommendedProducts[] = $honeyDalgona;
        } elseif (str_contains($message, 'cokelat') || str_contains($message, 'chocolate') || str_contains($message, 'choco')) {
            $reply = "Bagi pencinta cokelat murni yang intens, Anda wajib mencoba **Belgian Chocolate Silky Pudding** dengan 70% dark cocoa dan espresso glaze.";
            $recommendedProducts[] = $choco;
        } else {
            $reply = "Halo! Senang bisa memandu selera Anda. Kami menyajikan dessert silky pudding sutra dan racikan kopi dalgona artisan. Beritahu kami mood atau preferensi rasa Anda hari ini (apakah creamy manis, kopi pekat, atau paket bundling), dan kami akan merekomendasikan hidangan terbaik!";
            $recommendedProducts[] = $bundle;
            $recommendedProducts[] = $pudding;
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

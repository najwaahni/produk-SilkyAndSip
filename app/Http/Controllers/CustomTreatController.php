<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Addon;
use Illuminate\Http\Request;

class CustomTreatController extends Controller
{
    public function index()
    {
        $baseProducts = Product::whereIn('slug', ['silky-pudding-caramel', 'coffee-dalgona', 'belgian-chocolate-silky-pudding'])->get();
        $addons = Addon::where('is_active', true)->get();

        return view('pages.custom-treat', compact('baseProducts', 'addons'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'base_id' => 'required|exists:products,id',
            'sweetness' => 'required|string',
            'addons' => 'nullable|array',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $baseProduct = Product::findOrFail($request->base_id);
        $sweetness = $request->sweetness;
        $quantity = (int) ($request->quantity ?? 1);
        $selectedAddons = [];
        $addonsPrice = 0;

        if ($request->has('addons')) {
            $addonModels = Addon::whereIn('id', $request->addons)->get();
            foreach ($addonModels as $addon) {
                $selectedAddons[] = [
                    'id' => $addon->id,
                    'name' => $addon->name,
                    'price' => $addon->price,
                ];
                $addonsPrice += $addon->price;
            }
        }

        $sweetnessExtra = ($sweetness === 'Extra Sweet') ? 500 : 0;
        $unitPrice = $baseProduct->price + $sweetnessExtra + $addonsPrice;

        $cart = session()->get('cart', []);
        $cartKey = 'custom_' . $baseProduct->id . '_' . md5($sweetness . json_encode($selectedAddons));

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
            $cart[$cartKey]['subtotal'] = $cart[$cartKey]['quantity'] * $unitPrice;
        } else {
            $cart[$cartKey] = [
                'type' => 'custom',
                'product_id' => $baseProduct->id,
                'name' => 'Custom ' . $baseProduct->name,
                'price' => $unitPrice,
                'base_price' => $baseProduct->price,
                'quantity' => $quantity,
                'image' => $baseProduct->image,
                'sweetness' => $sweetness,
                'sweetness_extra' => $sweetnessExtra,
                'addons' => $selectedAddons,
                'subtotal' => $unitPrice * $quantity,
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Custom treat added to cart!',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Custom treat created and added to cart!');
    }
}

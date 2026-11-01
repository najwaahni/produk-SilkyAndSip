<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Addon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['subtotal'];
        }

        // Delivery fee: Rp 5.000, free for orders >= Rp 35.000
        $deliveryFee = ($subtotal >= 35000 || $subtotal == 0) ? 0 : 5000;
        // Service tax: 10%
        $taxAmount = round($subtotal * 0.10);
        $total = $subtotal + $deliveryFee + $taxAmount;

        $addons = Addon::where('is_active', true)->get();

        return view('pages.cart', compact('cart', 'subtotal', 'deliveryFee', 'taxAmount', 'total', 'addons'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'sweetness' => 'nullable|string',
            'addons' => 'nullable|array',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = (int) ($request->quantity ?? 1);
        $sweetness = $request->sweetness ?? 'Regular';

        $selectedAddons = [];
        $addonsPrice = 0;

        if ($request->has('addons')) {
            $addonModels = Addon::whereIn('id', (array)$request->addons)->get();
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
        $unitPrice = $product->price + $sweetnessExtra + $addonsPrice;

        $cart = session()->get('cart', []);
        $cartKey = 'prod_' . $product->id . '_' . md5($sweetness . json_encode($selectedAddons));

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
            $cart[$cartKey]['subtotal'] = $cart[$cartKey]['quantity'] * $unitPrice;
        } else {
            $cart[$cartKey] = [
                'type' => 'product',
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $unitPrice,
                'base_price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
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
                'message' => "{$product->name} berhasil ditambahkan ke keranjang!",
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'cart_subtotal' => array_sum(array_column($cart, 'subtotal')),
            ]);
        }

        return redirect()->back()->with('success', "{$product->name} ditambahkan ke keranjang!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = (int) $request->quantity;
            $cart[$request->key]['subtotal'] = $cart[$request->key]['quantity'] * $cart[$request->key]['price'];
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            $subtotal = array_sum(array_column($cart, 'subtotal'));
            $deliveryFee = ($subtotal >= 35000 || $subtotal == 0) ? 0 : 5000;
            $taxAmount = round($subtotal * 0.10);
            $total = $subtotal + $deliveryFee + $taxAmount;

            return response()->json([
                'success' => true,
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'item_subtotal' => 'Rp ' . number_format($cart[$request->key]['subtotal'] ?? 0, 0, ',', '.'),
                'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                'delivery_fee' => 'Rp ' . number_format($deliveryFee, 0, ',', '.'),
                'tax_amount' => 'Rp ' . number_format($taxAmount, 0, ',', '.'),
                'total' => 'Rp ' . number_format($total, 0, ',', '.'),
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->key])) {
            unset($cart[$request->key]);
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            $subtotal = array_sum(array_column($cart, 'subtotal'));
            $deliveryFee = ($subtotal >= 35000 || $subtotal == 0) ? 0 : 5000;
            $taxAmount = round($subtotal * 0.10);
            $total = $subtotal + $deliveryFee + $taxAmount;

            return response()->json([
                'success' => true,
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                'delivery_fee' => 'Rp ' . number_format($deliveryFee, 0, ',', '.'),
                'tax_amount' => 'Rp ' . number_format($taxAmount, 0, ',', '.'),
                'total' => 'Rp ' . number_format($total, 0, ',', '.'),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'whatsapp_number' => 'required|string|max:30',
            'delivery_address' => 'required|string|max:500',
            'delivery_notes' => 'nullable|string|max:300',
            'payment_method' => 'required|string|in:qris,bank_transfer,ewallet,cod',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['subtotal'];
        }

        $deliveryFee = ($subtotal >= 35000 || $subtotal == 0) ? 0 : 5000;
        $taxAmount = round($subtotal * 0.10);
        $totalAmount = $subtotal + $deliveryFee + $taxAmount;

        // Generate receipt code: #SLK-XXXXX (like in prototype SLK-79401)
        $orderNumber = 'SLK-' . strtoupper(Str::random(5));

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $request->customer_name,
            'whatsapp_number' => $request->whatsapp_number,
            'delivery_address' => $request->delivery_address,
            'delivery_notes' => $request->delivery_notes,
            'payment_method' => $request->payment_method,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => 'preparing',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'] ?? null,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'sweetness' => $item['sweetness'] ?? 'Regular',
                'selected_addons' => $item['addons'] ?? [],
                'subtotal' => $item['subtotal'],
            ]);
        }

        // Clear session cart
        session()->forget('cart');

        return redirect()->route('order.success', $order->id)->with('success', 'Pesanan Anda berhasil dikonfirmasi!');
    }
}


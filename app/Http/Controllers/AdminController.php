<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Order::with('items')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->paginate(15);
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $preparingOrders = Order::where('status', 'preparing')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        return view('pages.admin', compact('orders', 'totalOrders', 'totalRevenue', 'preparingOrders', 'completedOrders', 'status'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,out_for_delivery,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', "Status pesanan #{$order->order_number} berhasil diperbarui.");
    }
}

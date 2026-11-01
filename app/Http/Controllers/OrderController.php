<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // Build WhatsApp message for instant confirmation
        $itemsText = "";
        foreach ($order->items as $item) {
            $addonNames = !empty($item->selected_addons) ? ' (Add-on: ' . implode(', ', array_column($item->selected_addons, 'name')) . ')' : '';
            $itemsText .= "- {$item->product_name} x{$item->quantity} [{$item->sweetness}]{$addonNames}: {$item->formatted_subtotal}%0A";
        }

        $waMessage = "Halo SILKY & SIP!%0ASaya telah memesan melalui website:%0A"
            . "*No. Resi:* #{$order->order_number}%0A"
            . "*Nama:* {$order->customer_name}%0A"
            . "*WhatsApp:* {$order->whatsapp_number}%0A"
            . "*Alamat:* {$order->delivery_address}%0A"
            . "*Metode:* {$order->payment_method_label}%0A"
            . "%0A*Detail Pesanan:*%0A"
            . $itemsText
            . "%0A*Total Bayar:* {$order->formatted_total}%0A"
            . "Mohon segera diproses ya! Terima kasih.";

        $waLink = "https://api.whatsapp.com/send?phone=" . preg_replace('/[^0-9]/', '', $order->whatsapp_number) . "&text=" . $waMessage;

        return view('pages.order-success', compact('order', 'waLink'));
    }

    public function invoice($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('pages.invoice', compact('order'));
    }
}


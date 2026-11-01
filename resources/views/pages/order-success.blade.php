@extends('layouts.app')

@section('title', 'Order Successful! - SILKY & SIP')

@section('content')
<div class="py-16 bg-pattern min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full mx-4">
        <!-- Order Successful Modal Card (Gambar 4.7) -->
        <div class="bg-white rounded-[2.5rem] p-8 sm:p-10 border border-brand-latte/70 shadow-2xl text-center space-y-6 relative overflow-hidden">
            <!-- Decorative top highlight -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-brand-amber via-brand-caramel to-brand-coffee"></div>

            <!-- Success Icon -->
            <div class="w-20 h-20 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl shadow-inner animate-bounce" style="animation-duration: 2s;">
                <i class="fa-solid fa-check"></i>
            </div>

            <!-- Title & Subtitle -->
            <div class="space-y-1">
                <h1 class="font-serif text-3xl font-bold text-brand-coffee">
                    Order Successful!
                </h1>
                <p class="text-xs font-mono font-bold text-brand-caramel">
                    Receipt #{{ $order->order_number }}
                </p>
            </div>

            <!-- Summary Table Details (Gambar 4.7) -->
            <div class="bg-brand-ivory/60 rounded-2xl p-5 border border-brand-latte/60 space-y-3 text-xs text-left">
                <div class="flex justify-between pb-2 border-b border-brand-latte/40">
                    <span class="text-brand-coffeeMuted">Recipient Name:</span>
                    <span class="font-bold text-brand-coffee">{{ $order->customer_name }}</span>
                </div>
                <div class="flex justify-between pb-2 border-b border-brand-latte/40">
                    <span class="text-brand-coffeeMuted">WhatsApp:</span>
                    <span class="font-bold text-brand-coffee">{{ $order->whatsapp_number }}</span>
                </div>
                <div class="flex justify-between pb-2 border-b border-brand-latte/40">
                    <span class="text-brand-coffeeMuted">Payment Method:</span>
                    <span class="font-bold text-brand-coffee">{{ $order->payment_method_label }}</span>
                </div>
                <div class="flex justify-between pb-2 border-b border-brand-latte/40">
                    <span class="text-brand-coffeeMuted">Delivery Address:</span>
                    <span class="font-bold text-brand-coffee text-right max-w-[60%]">{{ $order->delivery_address }}</span>
                </div>
                <div class="flex justify-between items-baseline pt-1">
                    <span class="text-brand-coffee font-bold">Total Paid:</span>
                    <span class="font-serif text-xl font-bold text-brand-caramel">{{ $order->formatted_total }}</span>
                </div>
            </div>

            <!-- Friendly Message -->
            <p class="text-xs text-brand-coffeeMuted leading-relaxed max-w-sm mx-auto">
                Silky is being lovingly prepared and will be delivered to your address shortly. We have also prepared your receipt for WhatsApp confirmation.
            </p>

            <!-- Action Buttons (Gambar 4.7) -->
            <div class="space-y-3 pt-2">
                <a href="{{ $waLink }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-full bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-700 transition-all shadow-md">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Kirim Konfirmasi Pesanan ke WhatsApp</span>
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="flex-1 py-3 px-4 rounded-full bg-brand-ivory text-brand-coffee font-semibold text-xs hover:bg-brand-latte transition-colors border border-brand-latte">
                        <i class="fa-solid fa-receipt mr-1"></i>Cetak Struk
                    </a>
                    <a href="{{ route('shop.index') }}" class="flex-1 py-3 px-4 rounded-full bg-brand-coffee text-white font-semibold text-xs hover:bg-brand-coffeeLight transition-colors">
                        Back to Shop
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


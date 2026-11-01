<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $order->order_number }} - SILKY & SIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-50 py-10 text-gray-800">
    <div class="max-w-xl mx-auto bg-white p-8 sm:p-10 rounded-2xl shadow-lg border border-gray-100 space-y-6">
        <!-- Print Header -->
        <div class="flex items-center justify-between border-b pb-6">
            <div>
                <h1 class="font-serif text-2xl font-bold text-gray-900">SILKY & SIP</h1>
                <p class="text-xs text-gray-500">Artisanal Dessert & Coffee • Palembang</p>
            </div>
            <div class="text-right">
                <span class="text-xs font-mono font-bold bg-amber-100 text-amber-800 px-3 py-1 rounded-full">
                    #{{ $order->order_number }}
                </span>
                <p class="text-[11px] text-gray-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
        </div>

        <!-- Customer info -->
        <div class="grid grid-cols-2 gap-4 text-xs">
            <div>
                <p class="text-gray-400 font-semibold uppercase tracking-wider text-[10px]">Tujuan Pengiriman</p>
                <p class="font-bold text-gray-800 mt-1">{{ $order->customer_name }}</p>
                <p class="text-gray-600 mt-0.5">{{ $order->whatsapp_number }}</p>
                <p class="text-gray-500 mt-0.5 leading-relaxed">{{ $order->delivery_address }}</p>
            </div>
            <div class="text-right">
                <p class="text-gray-400 font-semibold uppercase tracking-wider text-[10px]">Metode Pembayaran</p>
                <p class="font-bold text-gray-800 mt-1">{{ $order->payment_method_label }}</p>
                <p class="text-gray-500 mt-0.5">Status: <span class="text-emerald-600 font-semibold uppercase">{{ $order->status }}</span></p>
            </div>
        </div>

        <!-- Items Table -->
        <div class="border-t border-b py-4 space-y-3">
            @foreach($order->items as $item)
                <div class="flex justify-between items-start text-xs">
                    <div>
                        <p class="font-bold text-gray-800">{{ $item->product_name }} x{{ $item->quantity }}</p>
                        <p class="text-[11px] text-gray-500">
                            {{ $item->sweetness ?? 'Regular' }}
                            @if(!empty($item->selected_addons))
                                • Add-ons: {{ implode(', ', array_column($item->selected_addons, 'name')) }}
                            @endif
                        </p>
                    </div>
                    <span class="font-bold text-gray-800">{{ $item->formatted_subtotal }}</span>
                </div>
            @endforeach
        </div>

        <!-- Calculation summary -->
        <div class="space-y-1.5 text-xs text-right">
            <div class="flex justify-between text-gray-600">
                <span>Subtotal:</span>
                <span>{{ $order->formatted_subtotal }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Biaya Pengiriman:</span>
                <span>{{ $order->delivery_fee > 0 ? 'Rp ' . number_format($order->delivery_fee, 0, ',', '.') : 'GRATIS' }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Pajak Layanan (10%):</span>
                <span>Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm font-bold text-gray-900 pt-2 border-t">
                <span>Total Pembayaran:</span>
                <span class="text-amber-700 font-serif text-lg">{{ $order->formatted_total }}</span>
            </div>
        </div>

        <!-- Footer / Print Action -->
        <div class="text-center pt-6 border-t text-xs text-gray-400 space-y-3">
            <p>Terima kasih telah memesan di SILKY & SIP. Semoga hari Anda menyenangkan!</p>
            <div class="no-print flex items-center justify-center gap-3">
                <button onclick="window.print()" class="px-5 py-2 rounded-full bg-gray-900 text-white font-bold hover:bg-gray-800 text-xs">
                    Cetak Struk
                </button>
                <a href="{{ route('home') }}" class="px-5 py-2 rounded-full bg-gray-100 text-gray-700 font-bold hover:bg-gray-200 text-xs">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>

@extends('layouts.app')

@section('title', 'Your Indulgence Cart & Checkout - SILKY & SIP')

@section('content')
<div class="py-12 bg-pattern min-h-screen" x-data="{
    paymentMethod: 'qris',
    recipientName: 'Alexandra Valerie',
    whatsappNumber: '081234567890',
    deliveryAddress: 'Jl. Palembang-Prabumulih KM. 32, Indralaya, Ogan Ilir, Sumatera Selatan',
    deliveryNotes: 'Tolong jangan dibanting ya, dessert silky pudding.',
    isSubmitting: false,
    formatRupiah(amount) {
        return 'Rp ' + Number(amount).toLocaleString('id-ID');
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Page Header -->
        <div class="flex items-center justify-between pb-6 border-b border-brand-latte/60">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-caramel block mb-1">Checkout Process</span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-brand-coffee">
                    Your Indulgence Cart
                </h1>
            </div>
            <a href="{{ route('shop.index') }}" class="text-xs font-bold text-brand-coffee hover:text-brand-caramel flex items-center gap-1.5 transition-colors">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Continue Shopping</span>
            </a>
        </div>

        @if(empty($cart) || count($cart) === 0)
            <!-- Empty Cart State -->
            <div class="bg-white rounded-3xl p-12 text-center max-w-xl mx-auto border border-brand-latte/60 shadow-soft space-y-5">
                <div class="w-20 h-20 mx-auto rounded-full bg-brand-ivory flex items-center justify-center text-brand-caramel text-3xl">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <h2 class="font-serif text-2xl font-bold text-brand-coffee">Keranjang Anda Masih Kosong</h2>
                <p class="text-xs sm:text-sm text-brand-coffeeMuted leading-relaxed">
                    Manjakan lidah Anda hari ini dengan silky pudding caramel lembut atau segarnya racikan whipped coffee dalgona kami.
                </p>
                <div class="pt-2">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-brand-coffee text-white font-bold text-xs hover:bg-brand-coffeeLight transition-all">
                        <span>Jelajahi Menu Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        @else
            <!-- Form covering both Cart Items & Checkout Info -->
            <form action="{{ route('checkout.process') }}" method="POST" @submit="isSubmitting = true">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                    <!-- Left Column: Selected Items & Delivery Information (Gambar 4.6) -->
                    <div class="lg:col-span-7 space-y-8">

                        <!-- Selected Items Container -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-brand-latte/60 shadow-soft space-y-6">
                            <div class="flex items-center justify-between pb-4 border-b border-brand-latte/40">
                                <h3 class="font-serif text-lg font-bold text-brand-coffee flex items-center gap-2">
                                    <span>Selected Items</span>
                                    <span class="text-xs font-bold text-brand-caramel bg-brand-ivory px-2.5 py-0.5 rounded-full">({{ count($cart) }})</span>
                                </h3>
                                <button type="submit" formaction="{{ route('cart.clear') }}" class="text-xs font-semibold text-rose-600 hover:text-rose-800 transition-colors">
                                    Clear Cart
                                </button>
                            </div>

                            <!-- Items List -->
                            <div class="space-y-4">
                                @foreach($cart as $key => $item)
                                    <div class="p-4 rounded-2xl bg-brand-ivory/40 border border-brand-latte/40 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <!-- Thumbnail & Info -->
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-brand-ivory flex-shrink-0 border border-brand-latte/50">
                                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="font-serif font-bold text-sm text-brand-coffee">{{ $item['name'] }}</h4>
                                                <div class="flex flex-wrap items-center gap-1.5 mt-0.5 text-[11px] text-brand-coffeeMuted">
                                                    <span class="font-semibold text-brand-caramel">{{ $item['sweetness'] ?? 'Regular' }}</span>
                                                    @if(!empty($item['addons']))
                                                        <span>• Add-on: {{ implode(', ', array_column($item['addons'], 'name')) }}</span>
                                                    @endif
                                                </div>
                                                <span class="text-xs font-bold text-brand-coffee block mt-1">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Quantity and Line Total -->
                                        <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4">
                                            <div class="inline-flex items-center border border-brand-latte rounded-full bg-white p-0.5 shadow-sm">
                                                <!-- We can decrease quantity via form submission or JS -->
                                                <button type="submit" formaction="{{ route('cart.update') }}" name="key" value="{{ $key }}" @click="$el.form.querySelector('input[name=quantity]').value = {{ max(1, $item['quantity'] - 1) }}" class="w-7 h-7 rounded-full bg-brand-ivory text-brand-coffee flex items-center justify-center text-xs font-bold hover:bg-brand-latte">
                                                    -
                                                </button>
                                                <span class="w-8 text-center text-xs font-bold text-brand-coffee">{{ $item['quantity'] }}</span>
                                                <button type="submit" formaction="{{ route('cart.update') }}" name="key" value="{{ $key }}" @click="$el.form.querySelector('input[name=quantity]').value = {{ $item['quantity'] + 1 }}" class="w-7 h-7 rounded-full bg-brand-ivory text-brand-coffee flex items-center justify-center text-xs font-bold hover:bg-brand-latte">
                                                    +
                                                </button>
                                            </div>

                                            <span class="text-sm font-bold text-brand-coffee min-w-[75px] text-right">
                                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                            </span>

                                            <!-- Remove single item button -->
                                            <button type="submit" formaction="{{ route('cart.remove') }}" name="key" value="{{ $key }}" class="text-brand-coffeeMuted hover:text-rose-600 transition-colors p-1" title="Hapus item">
                                                <i class="fa-regular fa-trash-can text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Delivery Information Form (Gambar 4.6) -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-brand-latte/60 shadow-soft space-y-6">
                            <div class="pb-3 border-b border-brand-latte/40">
                                <h3 class="font-serif text-lg font-bold text-brand-coffee flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-brand-caramel"></i>
                                    <span>Delivery Information</span>
                                </h3>
                                <p class="text-xs text-brand-coffeeMuted">Pastikan alamat dan nomor kontak aktif untuk konfirmasi kurir.</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-brand-coffee">Recipient Name *</label>
                                    <input type="text" name="customer_name" x-model="recipientName" required placeholder="e.g. Alexandra Valerie" class="w-full px-4 py-3 rounded-2xl bg-brand-ivory/60 border border-brand-latte/70 text-xs text-brand-coffee focus:outline-none focus:border-brand-caramel focus:bg-white transition-all">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-brand-coffee">WhatsApp Number *</label>
                                    <input type="text" name="whatsapp_number" x-model="whatsappNumber" required placeholder="e.g. +62 812-3456-7890" class="w-full px-4 py-3 rounded-2xl bg-brand-ivory/60 border border-brand-latte/70 text-xs text-brand-coffee focus:outline-none focus:border-brand-caramel focus:bg-white transition-all">
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-bold text-brand-coffee">Delivery Address *</label>
                                    <textarea name="delivery_address" x-model="deliveryAddress" rows="3" required placeholder="Street address, apartment, suite, landmark..." class="w-full px-4 py-3 rounded-2xl bg-brand-ivory/60 border border-brand-latte/70 text-xs text-brand-coffee focus:outline-none focus:border-brand-caramel focus:bg-white transition-all"></textarea>
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-bold text-brand-coffee">Order Notes / Catatan Pengiriman (Opsional)</label>
                                    <input type="text" name="delivery_notes" x-model="deliveryNotes" placeholder="Misal: Taruh di meja pos satpam atau jangan terlalu manis..." class="w-full px-4 py-3 rounded-2xl bg-brand-ivory/60 border border-brand-latte/70 text-xs text-brand-coffee focus:outline-none focus:border-brand-caramel focus:bg-white transition-all">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Payment Method & Order Summary (Gambar 4.6) -->
                    <div class="lg:col-span-5 space-y-6">

                        <!-- Payment Method Box -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-brand-latte/60 shadow-soft space-y-5">
                            <h3 class="font-serif text-lg font-bold text-brand-coffee flex items-center gap-2">
                                <i class="fa-solid fa-credit-card text-brand-caramel"></i>
                                <span>Payment Method</span>
                            </h3>

                            <div class="grid grid-cols-2 gap-3">
                                <!-- QRIS Instant -->
                                <label :class="paymentMethod === 'qris' ? 'border-brand-caramel bg-brand-ivory/80 ring-2 ring-brand-caramel/20' : 'border-brand-latte/60 hover:bg-brand-ivory/30'" class="p-3.5 rounded-2xl border cursor-pointer transition-all flex flex-col items-center text-center gap-2">
                                    <input type="radio" name="payment_method" value="qris" x-model="paymentMethod" class="sr-only">
                                    <div class="w-8 h-8 rounded-xl bg-brand-caramel/10 text-brand-caramel flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-qrcode"></i>
                                    </div>
                                    <span class="text-xs font-bold text-brand-coffee">QRIS Instant</span>
                                </label>

                                <!-- Bank Transfer -->
                                <label :class="paymentMethod === 'bank_transfer' ? 'border-brand-caramel bg-brand-ivory/80 ring-2 ring-brand-caramel/20' : 'border-brand-latte/60 hover:bg-brand-ivory/30'" class="p-3.5 rounded-2xl border cursor-pointer transition-all flex flex-col items-center text-center gap-2">
                                    <input type="radio" name="payment_method" value="bank_transfer" x-model="paymentMethod" class="sr-only">
                                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-building-columns"></i>
                                    </div>
                                    <span class="text-xs font-bold text-brand-coffee">Bank Transfer</span>
                                </label>

                                <!-- E-Wallet -->
                                <label :class="paymentMethod === 'ewallet' ? 'border-brand-caramel bg-brand-ivory/80 ring-2 ring-brand-caramel/20' : 'border-brand-latte/60 hover:bg-brand-ivory/30'" class="p-3.5 rounded-2xl border cursor-pointer transition-all flex flex-col items-center text-center gap-2">
                                    <input type="radio" name="payment_method" value="ewallet" x-model="paymentMethod" class="sr-only">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <span class="text-xs font-bold text-brand-coffee">E-Wallet</span>
                                </label>

                                <!-- Cash on Delivery -->
                                <label :class="paymentMethod === 'cod' ? 'border-brand-caramel bg-brand-ivory/80 ring-2 ring-brand-caramel/20' : 'border-brand-latte/60 hover:bg-brand-ivory/30'" class="p-3.5 rounded-2xl border cursor-pointer transition-all flex flex-col items-center text-center gap-2">
                                    <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="sr-only">
                                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-hand-holding-dollar"></i>
                                    </div>
                                    <span class="text-xs font-bold text-brand-coffee">Cash on Delivery</span>
                                </label>
                            </div>

                            <!-- Payment Details Preview Box -->
                            <div class="p-4 rounded-2xl bg-brand-ivory/60 border border-brand-latte/50 text-xs">
                                <div x-show="paymentMethod === 'qris'" class="space-y-1 text-center">
                                    <p class="font-bold text-brand-coffee">Scan QRIS Instant Semua Aplikasi</p>
                                    <p class="text-[11px] text-brand-coffeeMuted">BCA, Mandiri, GoPay, OVO, ShopeePay, Dana.</p>
                                </div>
                                <div x-show="paymentMethod === 'bank_transfer'" class="space-y-1">
                                    <p class="font-bold text-brand-coffee">Transfer Bank Manual:</p>
                                    <p class="text-[11px] text-brand-coffeeMuted">BCA: 8901-2291-00 (a.n SILKY & SIP)</p>
                                </div>
                                <div x-show="paymentMethod === 'ewallet'" class="space-y-1">
                                    <p class="font-bold text-brand-coffee">E-Wallet Indonesia:</p>
                                    <p class="text-[11px] text-brand-coffeeMuted">GoPay / OVO / Dana: 0812-3456-7890</p>
                                </div>
                                <div x-show="paymentMethod === 'cod'" class="space-y-1">
                                    <p class="font-bold text-brand-coffee">Bayar Tunai di Tempat (COD):</p>
                                    <p class="text-[11px] text-brand-coffeeMuted">Siapkan uang pas saat pesanan tiba di alamat Anda.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Box (Gambar 4.6) -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-brand-latte/60 shadow-warm space-y-6">
                            <h3 class="font-serif text-lg font-bold text-brand-coffee">
                                Order Summary
                            </h3>

                            <div class="space-y-3 text-xs">
                                <div class="flex justify-between text-brand-coffeeMuted">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-brand-coffee">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                <div class="flex justify-between text-brand-coffeeMuted">
                                    <span>Delivery Fee (Flat Rate)</span>
                                    @if($deliveryFee === 0)
                                        <span class="font-bold text-emerald-600">FREE</span>
                                    @else
                                        <span class="font-bold text-brand-coffee">Rp {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                <div class="flex justify-between text-brand-coffeeMuted">
                                    <span>Service Tax (10%)</span>
                                    <span class="font-bold text-brand-coffee">Rp {{ number_format($taxAmount, 0, ',', '.') }}</span>
                                </div>

                                <div class="pt-4 border-t border-brand-latte/60 flex justify-between items-baseline">
                                    <span class="font-bold text-sm text-brand-coffee">Total Payment</span>
                                    <span class="font-serif text-2xl font-bold text-brand-caramel">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Confirm & Complete Order Button (Gambar 4.6) -->
                            <button type="submit" :disabled="isSubmitting" class="w-full py-4 rounded-full bg-brand-coffee text-white font-bold text-sm hover:bg-brand-coffeeLight hover:shadow-warm transition-all flex items-center justify-center gap-2 group">
                                <span x-show="!isSubmitting">Confirm & Complete Order</span>
                                <span x-show="isSubmitting">Memproses Pesanan...</span>
                                <i x-show="!isSubmitting" class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>

                    </div>

                </div>
            </form>
        @endif

    </div>
</div>
@endsection


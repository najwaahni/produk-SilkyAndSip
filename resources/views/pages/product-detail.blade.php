@extends('layouts.app')

@section('title', $product->name . ' - SILKY & SIP')

@section('content')
<div class="py-12 bg-pattern min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-coffeeMuted">
            <a href="{{ route('home') }}" class="hover:text-brand-coffee">Home</a>
            <span>/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-brand-coffee">Shop</a>
            <span>/</span>
            <span class="text-brand-caramel">{{ $product->name }}</span>
        </nav>

        <!-- Product Hero Card -->
        <div class="bg-white rounded-3xl border border-brand-latte/60 shadow-warm overflow-hidden" x-data="{
            basePrice: {{ $product->price }},
            qty: 1,
            selectedAddons: [],
            sweetness: 'Regular',
            addonsPrice() {
                let total = 0;
                @foreach($addons as $ad)
                    if (this.selectedAddons.includes('{{ $ad->id }}')) {
                        total += {{ $ad->price }};
                    }
                @endforeach
                return total;
            },
            totalPrice() {
                let sweetnessExtra = this.sweetness === 'Extra Sweet' ? 500 : 0;
                return (this.basePrice + sweetnessExtra + this.addonsPrice()) * this.qty;
            },
            formatRupiah(amount) {
                return 'Rp ' + amount.toLocaleString('id-ID');
            }
        }">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 p-6 sm:p-10">
                <!-- Image Side -->
                <div class="space-y-4">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-brand-ivory border border-brand-latte/40 shadow-inner">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Dietary badges -->
                    <div class="flex items-center gap-2 text-[11px] font-bold text-brand-coffeeMuted">
                        <span class="px-3 py-1 bg-brand-ivory rounded-full border border-brand-latte/40">🌿 Fresh Daily</span>
                        <span class="px-3 py-1 bg-brand-ivory rounded-full border border-brand-latte/40">⭐ {{ $product->rating }} Rating</span>
                        <span class="px-3 py-1 bg-brand-ivory rounded-full border border-brand-latte/40">{{ $product->category->name }}</span>
                    </div>
                </div>

                <!-- Product Form Side -->
                <div class="space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-brand-caramel">{{ $product->category->name }}</span>
                            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-brand-coffee">{{ $product->name }}</h1>
                            <div class="flex items-baseline gap-3 pt-1">
                                <span class="font-serif text-2xl font-bold text-brand-caramel" x-text="formatRupiah(totalPrice())">
                                    {{ $product->formatted_price }}
                                </span>
                                @if($product->formatted_original_price)
                                    <span class="text-sm text-brand-coffeeMuted line-through">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>
                        </div>

                        <p class="text-sm text-brand-coffeeMuted leading-relaxed">
                            {{ $product->description }}
                        </p>

                        <!-- Sweetness Level -->
                        <div class="space-y-2 pt-2 border-t border-brand-latte/40">
                            <label class="text-xs font-bold text-brand-coffee uppercase tracking-wider block">Tingkat Kemanisan:</label>
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" @click="sweetness = 'Less Sweet'" :class="sweetness === 'Less Sweet' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 px-3 rounded-xl text-xs transition-all border border-brand-latte/60">
                                    Less Sweet
                                </button>
                                <button type="button" @click="sweetness = 'Regular'" :class="sweetness === 'Regular' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 px-3 rounded-xl text-xs transition-all border border-brand-latte/60">
                                    Regular (100%)
                                </button>
                                <button type="button" @click="sweetness = 'Extra Sweet'" :class="sweetness === 'Extra Sweet' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 px-3 rounded-xl text-xs transition-all border border-brand-latte/60">
                                    Extra (+Rp 500)
                                </button>
                            </div>
                        </div>

                        <!-- Add-ons selection -->
                        <div class="space-y-2 pt-2 border-t border-brand-latte/40">
                            <label class="text-xs font-bold text-brand-coffee uppercase tracking-wider block">Artisanal Add-ons:</label>
                            <div class="space-y-1.5">
                                @foreach($addons as $addon)
                                    <label class="flex items-center justify-between text-xs p-2.5 rounded-xl bg-brand-ivory/60 border border-brand-latte/40 hover:bg-brand-ivory cursor-pointer transition-colors">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" value="{{ $addon->id }}" x-model="selectedAddons" class="rounded border-brand-latte text-brand-caramel focus:ring-brand-caramel">
                                            <div>
                                                <span class="font-medium text-brand-coffee">{{ $addon->name }}</span>
                                                <span class="text-[10px] text-brand-coffeeMuted block">{{ $addon->description }}</span>
                                            </div>
                                        </div>
                                        <span class="text-brand-caramel font-bold">+{{ $addon->formatted_price }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Ingredients & Allergens Box -->
                        <div class="p-3.5 bg-brand-ivory rounded-2xl border border-brand-latte/60 text-xs space-y-1">
                            <p class="font-semibold text-brand-coffee">🌾 <strong>Komposisi:</strong> {{ $product->ingredients }}</p>
                            <p class="text-amber-800">⚠️ <strong>Alergen:</strong> {{ $product->allergens }}</p>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" class="pt-4 border-t border-brand-latte/60 space-y-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="sweetness" :value="sweetness">
                        <template x-for="adId in selectedAddons" :key="adId">
                            <input type="hidden" name="addons[]" :value="adId">
                        </template>

                        <div class="flex items-center gap-3">
                            <div class="inline-flex items-center border border-brand-latte rounded-full bg-brand-ivory p-1">
                                <button type="button" @click="if (qty > 1) qty--" class="w-8 h-8 rounded-full bg-white text-brand-coffee flex items-center justify-center text-sm font-bold shadow-sm">
                                    -
                                </button>
                                <input type="number" name="quantity" x-model.number="qty" min="1" class="w-10 text-center text-sm font-bold bg-transparent border-0 focus:ring-0 text-brand-coffee p-0" readonly>
                                <button type="button" @click="qty++" class="w-8 h-8 rounded-full bg-white text-brand-coffee flex items-center justify-center text-sm font-bold shadow-sm">
                                    +
                                </button>
                            </div>

                            <button type="submit" class="flex-1 py-3 px-6 rounded-full bg-brand-coffee text-white font-bold text-xs hover:bg-brand-coffeeLight hover:shadow-soft transition-all">
                                <i class="fa-solid fa-plus mr-1.5"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="space-y-6 pt-4">
                <h3 class="font-serif text-2xl font-bold text-brand-coffee">Menu Terkait Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $rel)
                        <a href="{{ route('shop.show', $rel->slug) }}" class="bg-white rounded-2xl border border-brand-latte/60 p-4 shadow-soft hover:shadow-warm transition-all group block">
                            <div class="aspect-[4/3] rounded-xl overflow-hidden bg-brand-ivory mb-3">
                                <img src="{{ asset($rel->image) }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            </div>
                            <h4 class="font-serif font-bold text-brand-coffee group-hover:text-brand-caramel transition-colors text-sm">{{ $rel->name }}</h4>
                            <p class="text-xs font-bold text-brand-caramel mt-1">{{ $rel->formatted_price }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

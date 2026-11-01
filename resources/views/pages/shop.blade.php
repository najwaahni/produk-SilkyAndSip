@extends('layouts.app')

@section('title', 'Indulgent Catalog - SILKY & SIP | Silky Pudding & Artisanal Coffee')

@section('content')
<div class="py-12 bg-pattern min-h-screen" x-data="{
    search: '{{ $search ?? '' }}',
    activeModal: null,
    allergensData: {}
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Page Header (Gambar 4.4) -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-brand-caramel block">Artisanal Menu</span>
            <h1 class="font-serif text-4xl sm:text-5xl font-bold text-brand-coffee">
                Indulgent Catalog
            </h1>
            <p class="text-sm sm:text-base text-brand-coffeeMuted">
                Choose your favorite treats and customize with our artisanal add-ons. Crafted daily with love and precision.
            </p>
        </div>

        <!-- Filter Bar & Search Bar (Gambar 4.4) -->
        <div class="bg-white p-4 sm:p-5 rounded-3xl border border-brand-latte/60 shadow-soft flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <a href="{{ route('shop.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold transition-all {{ empty($categorySlug) || $categorySlug === 'all' ? 'bg-brand-coffee text-white shadow-sm' : 'bg-brand-ivory text-brand-coffeeMuted hover:text-brand-coffee' }}">
                    All Creations
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="px-5 py-2.5 rounded-full text-xs font-bold transition-all {{ ($categorySlug ?? '') === $category->slug ? 'bg-brand-coffee text-white shadow-sm' : 'bg-brand-ivory text-brand-coffeeMuted hover:text-brand-coffee' }}">
                        {{ $category->name }} ({{ $category->products_count }})
                    </a>
                @endforeach
            </div>

            <!-- Search Input -->
            <form action="{{ route('shop.index') }}" method="GET" class="w-full md:w-72 relative">
                @if(!empty($categorySlug) && $categorySlug !== 'all')
                    <input type="hidden" name="category" value="{{ $categorySlug }}">
                @endif
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search treats & flavors..." class="w-full pl-10 pr-4 py-2.5 text-xs bg-brand-ivory border border-brand-latte/60 rounded-full focus:outline-none focus:border-brand-caramel focus:bg-white transition-all text-brand-coffee placeholder:text-brand-coffeeMuted/60">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-brand-coffeeMuted text-xs"></i>
                @if(!empty($search))
                    <a href="{{ route('shop.index', !empty($categorySlug) ? ['category' => $categorySlug] : []) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-brand-coffeeMuted hover:text-brand-coffee text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </form>
        </div>

        <!-- Products Grid (Gambar 4.4) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl border border-brand-latte/60 shadow-soft hover:shadow-warm transition-all duration-300 flex flex-col overflow-hidden" x-data="{
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
                    <!-- Product Image -->
                    <div class="relative aspect-[4/3] bg-brand-ivory overflow-hidden group">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($product->original_price)
                            <div class="absolute top-4 left-4 bg-rose-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Hemat Rp {{ number_format($product->original_price - $product->price, 0, ',', '.') }}
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-full text-xs font-bold text-brand-coffee flex items-center gap-1 shadow-sm">
                            <i class="fa-solid fa-star text-amber-500 text-[10px]"></i>
                            <span>{{ $product->rating }}</span>
                            <span class="text-brand-coffeeMuted text-[10px]">({{ $product->reviews_count }})</span>
                        </div>
                    </div>

                    <!-- Product Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-5">
                        <div class="space-y-3">
                            <!-- Title & Price -->
                            <div class="flex items-baseline justify-between gap-2">
                                <h3 class="font-serif text-xl font-bold text-brand-coffee">
                                    {{ $product->name }}
                                </h3>
                                <div class="text-right">
                                    <span class="font-bold text-base text-brand-coffee" x-text="formatRupiah(totalPrice())">
                                        {{ $product->formatted_price }}
                                    </span>
                                    @if($product->formatted_original_price)
                                        <span class="text-[11px] text-brand-coffeeMuted/70 line-through block">{{ $product->formatted_original_price }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-xs text-brand-coffeeMuted leading-relaxed">
                                {{ $product->description }}
                            </p>

                            <!-- Add-ons Selection Checkboxes (Gambar 4.4) -->
                            <div class="pt-3 border-t border-brand-latte/40 space-y-2">
                                <span class="text-[11px] font-bold text-brand-coffee/80 uppercase tracking-wider block">Add-ons:</span>
                                <div class="space-y-1.5">
                                    @foreach($addons as $addon)
                                        <label class="flex items-center justify-between text-xs p-2 rounded-xl bg-brand-ivory/60 border border-brand-latte/40 hover:bg-brand-ivory cursor-pointer transition-colors">
                                            <div class="flex items-center gap-2">
                                                <input type="checkbox" value="{{ $addon->id }}" x-model="selectedAddons" class="rounded border-brand-latte text-brand-caramel focus:ring-brand-caramel">
                                                <span class="font-medium text-brand-coffee">{{ $addon->name }}</span>
                                            </div>
                                            <span class="text-brand-caramel font-bold text-[11px]">+{{ $addon->formatted_price }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Ingredients & Allergens Trigger (Gambar 4.4) -->
                            <div class="pt-1">
                                <button type="button" @click="activeModal = {{ $product->id }}" class="text-[11px] font-semibold text-brand-caramel hover:text-brand-caramelDark underline flex items-center gap-1">
                                    <i class="fa-solid fa-circle-info text-[10px]"></i>
                                    <span>Ingredients & Allergens</span>
                                </button>
                            </div>
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST" class="pt-4 border-t border-brand-latte/50 space-y-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="sweetness" :value="sweetness">
                            <template x-for="adId in selectedAddons" :key="adId">
                                <input type="hidden" name="addons[]" :value="adId">
                            </template>

                            <div class="flex items-center gap-3">
                                <!-- Quantity Controls -->
                                <div class="inline-flex items-center border border-brand-latte rounded-full bg-brand-ivory p-1">
                                    <button type="button" @click="if (qty > 1) qty--" class="w-7 h-7 rounded-full bg-white text-brand-coffee flex items-center justify-center text-xs hover:bg-brand-latte transition-colors shadow-sm">
                                        -
                                    </button>
                                    <input type="number" name="quantity" x-model.number="qty" min="1" class="w-10 text-center text-xs font-bold bg-transparent border-0 focus:ring-0 text-brand-coffee p-0" readonly>
                                    <button type="button" @click="qty++" class="w-7 h-7 rounded-full bg-white text-brand-coffee flex items-center justify-center text-xs hover:bg-brand-latte transition-colors shadow-sm">
                                        +
                                    </button>
                                </div>

                                <!-- Add to Cart Button -->
                                <button type="submit" class="flex-1 py-2.5 px-4 rounded-full bg-brand-coffee text-white font-semibold text-xs hover:bg-brand-coffeeLight hover:shadow-soft transition-all duration-200">
                                    Add to Cart
                                </button>

                                <!-- Buy Now Button -->
                                <button type="submit" formaction="{{ route('cart.add') }}?buynow=1" class="py-2.5 px-4 rounded-full bg-brand-caramel text-white font-semibold text-xs hover:bg-brand-caramelDark hover:shadow-warm transition-all duration-200">
                                    Buy Now
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Ingredients & Allergens Modal -->
                    <div x-show="activeModal === {{ $product->id }}" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" @click.self="activeModal = null">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-4 border border-brand-latte relative">
                            <button @click="activeModal = null" class="absolute top-5 right-5 text-brand-coffeeMuted hover:text-brand-coffee w-8 h-8 rounded-full bg-brand-ivory flex items-center justify-center">
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                            <div class="space-y-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-brand-caramel">Nutritional & Dietary Info</span>
                                <h4 class="font-serif text-2xl font-bold text-brand-coffee">{{ $product->name }}</h4>
                            </div>

                            <div class="space-y-3 text-xs leading-relaxed">
                                <div class="p-3.5 bg-brand-ivory rounded-2xl border border-brand-latte/50">
                                    <h5 class="font-bold text-brand-coffee mb-1 flex items-center gap-2">
                                        <i class="fa-solid fa-leaf text-emerald-600"></i>
                                        <span>Komposisi / Ingredients:</span>
                                    </h5>
                                    <p class="text-brand-coffeeMuted">{{ $product->ingredients ?? 'Fresh Cream, Madagascar Vanilla Bean, Organic Milk.' }}</p>
                                </div>

                                <div class="p-3.5 bg-amber-50 rounded-2xl border border-amber-200">
                                    <h5 class="font-bold text-amber-900 mb-1 flex items-center gap-2">
                                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                                        <span>Informasi Alergen / Allergens:</span>
                                    </h5>
                                    <p class="text-amber-800">{{ $product->allergens ?? 'Mengandung susu/dairy.' }}</p>
                                </div>
                            </div>

                            <div class="pt-2 text-right">
                                <button type="button" @click="activeModal = null" class="px-6 py-2 rounded-full bg-brand-coffee text-white text-xs font-bold hover:bg-brand-coffeeLight">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-brand-latte/60 p-8 space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-full bg-brand-ivory flex items-center justify-center text-brand-caramel text-2xl">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-brand-coffee">Tidak ada menu yang ditemukan</h3>
                    <p class="text-sm text-brand-coffeeMuted max-w-md mx-auto">
                        Coba gunakan kata kunci pencarian yang lain atau kembali ke seluruh kategori menu.
                    </p>
                    <a href="{{ route('shop.index') }}" class="inline-block px-6 py-2.5 rounded-full bg-brand-coffee text-white font-semibold text-xs hover:bg-brand-coffeeLight">
                        Lihat Seluruh Menu
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

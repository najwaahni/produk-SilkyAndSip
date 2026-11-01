@extends('layouts.app')

@section('title', 'SILKY & SIP - Lembut di Lidah, Manis Bersua Serasi | Artisanal Dessert & Coffee')

@section('content')
<!-- Hero Section (Gambar 4.1) -->
<section class="relative overflow-hidden pt-8 pb-16 lg:pt-16 lg:pb-24">
    <!-- Decorative background glow -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-latte/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Column: Copy & CTAs -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Tagline Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-ivory border border-brand-latte text-brand-caramel text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-sparkles text-[10px]"></i>
                    <span>Artisanal Indulgence</span>
                </div>

                <!-- Main Heading -->
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-brand-coffee leading-[1.15]">
                    Lembut di lidah,<br>
                    <span class="text-brand-caramel italic font-normal">Manis Bersua Serasi.</span>
                </h1>

                <!-- Subheading -->
                <p class="text-base sm:text-lg text-brand-coffeeMuted max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Experience the ultimate melt-in-your-mouth texture paired with perfectly whipped creamy coffee. Crafted daily with premium ingredients for your ultimate comfort moment.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ route('shop.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-brand-coffee text-white font-semibold text-sm hover:bg-brand-coffeeLight hover:shadow-warm transition-all duration-300 group">
                        <span>Shop Now</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('custom.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-white border border-brand-latte text-brand-coffee font-semibold text-sm hover:border-brand-caramel hover:shadow-soft transition-all duration-300">
                        <i class="fa-solid fa-wand-magic-sparkles text-brand-caramel"></i>
                        <span>Build Your Treat</span>
                    </a>
                </div>

                <!-- Key Value Badges -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-brand-latte/60 max-w-lg mx-auto lg:mx-0 text-left">
                    <div class="space-y-1">
                        <p class="font-serif text-2xl font-bold text-brand-coffee">100%</p>
                        <p class="text-xs text-brand-coffeeMuted font-medium">Madagascar Vanilla</p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-serif text-2xl font-bold text-brand-coffee">Single</p>
                        <p class="text-xs text-brand-coffeeMuted font-medium">Origin Arabica</p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-serif text-2xl font-bold text-brand-coffee">Daily</p>
                        <p class="text-xs text-brand-coffeeMuted font-medium">Freshly Whipped</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visual Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Main Card Image -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-[4/5] bg-brand-ivory group">
                        <img src="{{ asset('images/hero_banner.jpg') }}" alt="Silky & SIP artisanal pairing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-coffee/70 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-6 left-6 right-6 text-white space-y-1">
                            <span class="inline-block px-3 py-1 bg-brand-caramel/90 backdrop-blur-md text-[11px] font-bold rounded-full uppercase tracking-wider">
                                Signature Duo
                            </span>
                            <h3 class="font-serif text-xl font-bold">Silky Pudding Caramel + Coffee Dalgona</h3>
                            <p class="text-xs text-brand-cream/80">Paduan lembut pudding sutra dan pekatnya whipped espresso.</p>
                        </div>
                    </div>

                    <!-- Floating Badge 1: Customer Rating -->
                    <div class="absolute -top-4 -left-4 sm:-left-6 bg-white/95 backdrop-blur-md px-4 py-3 rounded-2xl shadow-xl border border-brand-latte/50 flex items-center gap-3 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center font-bold text-lg">
                            ★
                        </div>
                        <div>
                            <p class="text-xs font-bold text-brand-coffee">4.9 / 5.0 Rating</p>
                            <p class="text-[10px] text-brand-coffeeMuted">500+ Pecinta Dessert</p>
                        </div>
                    </div>

                    <!-- Floating Badge 2: Special Promo Pill -->
                    <div class="absolute -bottom-4 -right-4 sm:-right-6 bg-brand-coffee text-white px-5 py-3.5 rounded-2xl shadow-xl flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-brand-caramel flex items-center justify-center text-white">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white">Bundle Hemat</p>
                            <p class="text-[11px] text-brand-amber font-semibold">Mulai Rp 23.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Signature Creations (Gambar 4.2) -->
<section class="py-16 bg-white border-y border-brand-latte/40" x-data="{ activeCategory: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header & Category Filter -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-caramel block mb-2">Curated Menu</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-coffee">
                    Signature Creations
                </h2>
                <p class="text-sm text-brand-coffeeMuted mt-1">
                    Cita rasa otentik yang diracik setiap pagi dengan ketelitian sempurna.
                </p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap items-center gap-2 p-1.5 bg-brand-ivory rounded-full border border-brand-latte/60">
                <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffeeMuted hover:text-brand-coffee'" class="px-4 py-2 rounded-full text-xs font-bold transition-all">
                    All Treats
                </button>
                <button @click="activeCategory = 'puddings'" :class="activeCategory === 'puddings' ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffeeMuted hover:text-brand-coffee'" class="px-4 py-2 rounded-full text-xs font-bold transition-all">
                    Silky Puddings
                </button>
                <button @click="activeCategory = 'drinks'" :class="activeCategory === 'drinks' ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffeeMuted hover:text-brand-coffee'" class="px-4 py-2 rounded-full text-xs font-bold transition-all">
                    Dalgona & Brews
                </button>
                <button @click="activeCategory = 'bundles'" :class="activeCategory === 'bundles' ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffeeMuted hover:text-brand-coffee'" class="px-4 py-2 rounded-full text-xs font-bold transition-all">
                    Bundles
                </button>
            </div>
        </div>

        <!-- Product Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($allProducts as $product)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug }}'" x-transition class="bg-brand-cream rounded-3xl border border-brand-latte/60 overflow-hidden shadow-soft hover:shadow-warm transition-all duration-300 flex flex-col group">
                    <!-- Image with Badge -->
                    <div class="relative aspect-[4/3] bg-brand-ivory overflow-hidden">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($product->original_price)
                            <div class="absolute top-4 left-4 bg-rose-600 text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                Hemat Rp {{ number_format($product->original_price - $product->price, 0, ',', '.') }}
                            </div>
                        @elseif($product->is_featured)
                            <div class="absolute top-4 left-4 bg-brand-caramel text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                Best Seller
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-full text-xs font-bold text-brand-coffee flex items-center gap-1 shadow-sm">
                            <i class="fa-solid fa-star text-amber-500 text-[10px]"></i>
                            <span>{{ $product->rating }}</span>
                            <span class="text-brand-coffeeMuted text-[10px]">({{ $product->reviews_count }})</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex items-baseline justify-between gap-2 mb-1.5">
                                <h3 class="font-serif text-xl font-bold text-brand-coffee group-hover:text-brand-caramel transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <div class="text-right">
                                    <span class="font-bold text-base text-brand-coffee block">{{ $product->formatted_price }}</span>
                                    @if($product->formatted_original_price)
                                        <span class="text-xs text-brand-coffeeMuted/70 line-through block">{{ $product->formatted_original_price }}</span>
                                    @endif
                                </div>
                            </div>
                            <p class="text-xs text-brand-coffeeMuted line-clamp-2 leading-relaxed">
                                {{ $product->description }}
                            </p>
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST" class="pt-2 border-t border-brand-latte/40">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="sweetness" value="Regular">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('shop.show', $product->slug) }}" class="px-3.5 py-2.5 rounded-full bg-brand-ivory text-brand-coffee font-semibold text-xs hover:bg-brand-latte transition-colors" title="Lihat detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-brand-coffee text-white font-semibold text-xs hover:bg-brand-coffeeLight hover:shadow-soft transition-all duration-200">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-brand-ivory border border-brand-latte text-brand-coffee font-bold text-sm hover:bg-white hover:border-brand-caramel transition-all">
                <span>Lihat Seluruh Menu di Indulgent Catalog</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>

<!-- Custom Treat / Interactive Studio Teaser (Gambar 4.3) -->
<section class="py-20 bg-brand-cream relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-brand-coffee to-brand-coffeeLight rounded-[2.5rem] p-8 sm:p-12 lg:p-16 text-white relative shadow-2xl overflow-hidden">
            <!-- Background aesthetic wave -->
            <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-brand-caramel/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center relative z-10">
                <div class="lg:col-span-7 space-y-6">
                    <span class="inline-block px-3.5 py-1 bg-brand-caramel/80 backdrop-blur-md rounded-full text-xs font-bold tracking-widest uppercase text-white">
                        Interactive Studio
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                        Craft Your Perfect Blend,<br>
                        <span class="text-brand-amber italic font-normal">Sesuai Selera Anda.</span>
                    </h2>
                    <p class="text-sm sm:text-base text-brand-cream/80 max-w-lg leading-relaxed">
                        Pilih dessert base favorit Anda, atur tingkat kemanisan yang pas di lidah, dan tambahkan artisanal add-ons seperti <strong>Wild Honey Drizzle</strong> atau <strong>Extra Caramel Sauce</strong> secara instan.
                    </p>

                    <!-- Add-ons pills preview -->
                    <div class="flex flex-wrap gap-3 pt-2">
                        @foreach($addons as $addon)
                            <div class="px-4 py-2 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/15 text-xs flex items-center gap-2">
                                <i class="fa-solid fa-check text-brand-amber"></i>
                                <span>{{ $addon->name }}</span>
                                <span class="text-brand-amber font-bold">({{ $addon->formatted_price }})</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('custom.index') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-brand-caramel text-white font-bold text-sm hover:bg-brand-caramelLight hover:scale-105 transition-all shadow-warm">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                            <span>Buka Custom Studio Sekarang</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/20 shadow-xl space-y-4 text-center">
                        <div class="w-20 h-20 mx-auto rounded-full bg-brand-caramel/30 flex items-center justify-center text-brand-amber text-3xl mb-2">
                            🍯
                        </div>
                        <h4 class="font-serif text-xl font-bold text-white">Live Customization Preview</h4>
                        <p class="text-xs text-brand-cream/70">
                            Pilih base Silky Pudding atau Dalgona Coffee, tentukan Less Sweet atau Extra Sweet, dan sistem akan langsung menghitung estimasi harga kreasi Anda secara real-time!
                        </p>
                        <div class="pt-2">
                            <span class="inline-block px-4 py-2 rounded-xl bg-white/20 text-white text-xs font-semibold">
                                Mulai dari Rp 12.000
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AI Assistant Spotlight (Gambar 4.5) -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 relative">
                <div class="bg-brand-ivory rounded-3xl p-6 sm:p-8 border border-brand-latte shadow-soft space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-brand-latte/60">
                        <div class="w-10 h-10 rounded-2xl bg-brand-caramel text-white flex items-center justify-center font-bold">
                            AI
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-brand-coffee">SILKY Assistant</h4>
                            <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                Online & Ready to curate
                            </p>
                        </div>
                    </div>

                    <!-- Mock chat bubbles -->
                    <div class="space-y-3 text-xs">
                        <div class="bg-white p-3.5 rounded-2xl rounded-tl-sm border border-brand-latte/40 text-brand-coffee leading-relaxed max-w-[85%] shadow-sm">
                            👋 Selamat datang di SILKY & SIP! Sedang mencari dessert manis lembut atau kopi pekat peneman santai sore?
                        </div>
                        <div class="bg-brand-coffee text-white p-3.5 rounded-2xl rounded-tr-sm ml-auto max-w-[80%] leading-relaxed shadow-sm">
                            Rekomendasi paket paling hemat untuk santai berdua dong!
                        </div>
                        <div class="bg-white p-3.5 rounded-2xl rounded-tl-sm border border-brand-latte/40 text-brand-coffee leading-relaxed max-w-[90%] shadow-sm space-y-2">
                            <p>Pilihan terbaik adalah <strong>Morning Indulgence Bundle</strong>! Dapatkan 1 Silky Pudding Caramel + 1 Coffee Dalgona hanya Rp 23.000 (Hemat Rp 4.000) ✨</p>
                            <span class="inline-block text-[10px] font-bold text-brand-caramel bg-brand-ivory px-2 py-0.5 rounded-full">Recommended Pairing</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-caramel block">Taste Architect</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-coffee leading-tight">
                    Bingung Memilih Menu?<br>
                    <span class="text-brand-caramel italic font-normal">Tanyakan pada SILKY Assistant.</span>
                </h2>
                <p class="text-sm text-brand-coffeeMuted leading-relaxed">
                    Asisten cerdas kami siap memberikan rekomendasi berbasis preferensi rasa (tingkat kemanisan, intensitas espresso, aroma madu) dan anggaran Anda dalam hitungan detik.
                </p>

                <div class="pt-2">
                    <a href="{{ route('ai.index') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-brand-coffee text-white font-semibold text-sm hover:bg-brand-coffeeLight hover:shadow-warm transition-all group">
                        <i class="fa-solid fa-robot text-brand-caramel"></i>
                        <span>Coba AI Assistant Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

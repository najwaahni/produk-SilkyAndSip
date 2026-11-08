@extends('layouts.app')

@section('title', 'SILKY & SIP - Lembut di Lidah, Manis Bersua Serasi | Artisanal Dessert & Coffee')

@section('content')
<!-- Hero Section (Gambar 4.1) -->
<section class="relative overflow-hidden pt-8 pb-16 lg:pt-16 lg:pb-24">
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
                        <p class="text-xs text-brand-coffeeMuted font-medium">Vanilla Bean Alami</p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-serif text-2xl font-bold text-brand-coffee">Hand</p>
                        <p class="text-xs text-brand-coffeeMuted font-medium">Whipped Coffee</p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-serif text-2xl font-bold text-brand-coffee">Daily</p>
                        <p class="text-xs text-brand-coffeeMuted font-medium">Freshly Made</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visual Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-[4/3] bg-brand-ivory group">
                        <img src="{{ asset('images/cand_bundle2.jpg') }}" alt="Kopi dan dessert SILKY & SIP" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-coffee/70 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white space-y-1">
                            <span class="inline-block px-3 py-1 bg-brand-caramel/90 backdrop-blur-md text-[11px] font-bold rounded-full uppercase tracking-wider">
                                Bundling Package
                            </span>
                            <h3 class="font-serif text-xl font-bold">Silky Pudding Caramel + Coffee Dalgona</h3>
                            <p class="text-xs text-brand-cream/80">Paduan lembut vanilla bean pudding dan whipped dalgona coffee.</p>
                        </div>
                    </div>

                    <!-- Floating Badge 1: Customer Rating -->
                    <div class="absolute -top-4 -left-4 sm:-left-6 bg-white/95 backdrop-blur-md px-4 py-3 rounded-2xl shadow-xl border border-brand-latte/50 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center font-bold text-lg">
                            ★
                        </div>
                        <div>
                            <p class="text-xs font-bold text-brand-coffee">5.0 / 5.0 Rating</p>
                            <p class="text-[10px] text-brand-coffeeMuted">210+ Ulasan Puas</p>
                        </div>
                    </div>

                    <!-- Floating Badge 2: Promo -->
                    <div class="absolute -bottom-4 -right-4 sm:-right-6 bg-brand-coffee text-white px-5 py-3.5 rounded-2xl shadow-xl flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-brand-caramel flex items-center justify-center text-white">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white">Hemat Rp 2.000</p>
                            <p class="text-[11px] text-brand-amber font-semibold">Bundling Rp 25.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CURATED MENU - Signature Creations (Exact Match With Uploaded Screenshot) -->
<section class="py-16 bg-[#FAF7F2] border-y border-brand-latte/40" x-data="{ activeCategory: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Bar: Header & Category Pills (Matching Screenshot) -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#9E6237] block mb-1">CURATED MENU</span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#2A1810]">
                    Signature Creations
                </h2>
            </div>

            <!-- Filter Buttons (All Treats, Silky Puddings, Dalgona & Brews, Bundles) -->
            <div class="flex flex-wrap items-center gap-2">
                <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-[#704214] text-white shadow-sm' : 'bg-[#EFE8DE] text-[#6A574D] hover:bg-[#E5DCCF]'" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all">
                    All Treats
                </button>
                <button @click="activeCategory = 'puddings'" :class="activeCategory === 'puddings' ? 'bg-[#704214] text-white shadow-sm' : 'bg-[#EFE8DE] text-[#6A574D] hover:bg-[#E5DCCF]'" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all">
                    Silky Puddings
                </button>
                <button @click="activeCategory = 'drinks'" :class="activeCategory === 'drinks' ? 'bg-[#704214] text-white shadow-sm' : 'bg-[#EFE8DE] text-[#6A574D] hover:bg-[#E5DCCF]'" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all">
                    Dalgona & Brews
                </button>
                <button @click="activeCategory = 'bundles'" :class="activeCategory === 'bundles' ? 'bg-[#704214] text-white shadow-sm' : 'bg-[#EFE8DE] text-[#6A574D] hover:bg-[#E5DCCF]'" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all">
                    Bundles
                </button>
            </div>
        </div>

        <!-- 3 Exact Product Cards (Matching Screenshot) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($allProducts as $product)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug }}'" x-transition class="bg-white rounded-2xl p-3 border border-brand-latte/50 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <!-- Image Container with Exact Top-Left Badge -->
                        <div class="relative aspect-[3/2] rounded-xl overflow-hidden bg-brand-ivory mb-3">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            
                            @if($product->slug === 'silky-pudding-caramel')
                                <div class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-sm text-[#4A2E1B] text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-sm">
                                    Best Seller
                                </div>
                            @elseif($product->slug === 'coffee-dalgona')
                                <div class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-sm text-[#4A2E1B] text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-sm">
                                    Staff Pick
                                </div>
                            @elseif($product->slug === 'bundling-package')
                                <div class="absolute top-2.5 left-2.5 bg-[#8E4B1B] text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-sm">
                                    Hemat Rp 2.000
                                </div>
                            @endif
                        </div>

                        <!-- Title and Price Row -->
                        <div class="flex items-baseline justify-between gap-2 px-1 mb-1.5">
                            <h3 class="font-serif font-bold text-base text-[#2C1810]">
                                {{ $product->name }}
                            </h3>
                            <span class="font-bold text-sm text-[#8E4B1B]">
                                {{ $product->formatted_price }}
                            </span>
                        </div>

                        <!-- Description -->
                        <p class="text-[11px] text-[#786A61] leading-relaxed px-1 mb-4 line-clamp-3">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Bottom Row: Rating on Left, Add to Cart on Right -->
                    <div class="flex items-center justify-between pt-2 border-t border-brand-latte/30 px-1">
                        <div class="flex items-center gap-1 text-xs text-[#2C1810] font-semibold">
                            <i class="fa-solid fa-star text-amber-500 text-[10px]"></i>
                            <span>{{ number_format($product->rating, 1) }}</span>
                            <span class="text-[#8C7E75] text-[11px]">({{ $product->reviews_count }})</span>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="sweetness" value="Regular">
                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#1F140E] text-white font-semibold text-xs hover:bg-[#382318] transition-colors">
                                <i class="fa-solid fa-plus text-[10px]"></i>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Custom Treat Studio Teaser (Gambar 4.3) -->
<section class="py-16 bg-brand-cream relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-brand-coffee to-brand-coffeeLight rounded-[2.5rem] p-8 sm:p-12 lg:p-14 text-white relative shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-4">
                    <span class="inline-block px-3 py-1 bg-brand-caramel/80 backdrop-blur-md rounded-full text-xs font-bold tracking-widest uppercase text-white">
                        Interactive Studio
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold leading-tight">
                        Craft Your Perfect Blend
                    </h2>
                    <p class="text-xs sm:text-sm text-brand-cream/80 max-w-lg leading-relaxed">
                        Pilih base <strong>Silky Pudding Caramel</strong> atau <strong>Coffee Dalgona</strong>, atur tingkat kemanisan (Less Sweet / Regular / Extra Sweet), dan tambahkan <strong>Wild Honey Drizzle</strong> atau <strong>Extra Caramel Sauce</strong>.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('custom.index') }}" class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-brand-caramel text-white font-bold text-xs hover:bg-brand-caramelLight transition-all shadow-warm">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                            <span>Buka Custom Studio</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5 text-center">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 space-y-3">
                        <div class="text-3xl">🍮 ☕</div>
                        <h4 class="font-serif font-bold text-lg text-white">2 Pilihan Base Eksklusif</h4>
                        <p class="text-xs text-brand-cream/70">
                            Silky Pudding (Rp 12.000) & Coffee Dalgona (Rp 15.000)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

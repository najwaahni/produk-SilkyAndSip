@extends('layouts.app')

@section('title', 'Interactive Studio - Custom Treat | SILKY & SIP')

@section('content')
<div class="py-12 bg-pattern min-h-screen" x-data="{
    baseProducts: [
        @foreach($baseProducts as $bp)
            {
                id: {{ $bp->id }},
                name: '{{ $bp->name }}',
                slug: '{{ $bp->slug }}',
                price: {{ $bp->price }},
                image: '{{ asset($bp->image) }}',
                tagline: '{{ $bp->short_description ?? $bp->description }}'
            },
        @endforeach
    ],
    selectedBase: 0,
    sweetness: 'Regular',
    selectedAddons: [],
    addons: [
        @foreach($addons as $ad)
            {
                id: {{ $ad->id }},
                name: '{{ $ad->name }}',
                price: {{ $ad->price }},
                description: '{{ $ad->description }}'
            },
        @endforeach
    ],
    qty: 1,

    currentBase() {
        return this.baseProducts[this.selectedBase];
    },

    sweetnessExtra() {
        return this.sweetness === 'Extra Sweet' ? 500 : 0;
    },

    addonsTotal() {
        let sum = 0;
        this.addons.forEach(ad => {
            if (this.selectedAddons.includes(ad.id)) {
                sum += ad.price;
            }
        });
        return sum;
    },

    unitPrice() {
        return this.currentBase().price + this.sweetnessExtra() + this.addonsTotal();
    },

    totalPrice() {
        return this.unitPrice() * this.qty;
    },

    formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Top Header & Banner (Gambar 4.3) -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-brand-caramel block">Interactive Studio</span>
            <h1 class="font-serif text-4xl sm:text-5xl font-bold text-brand-coffee">
                Craft Your Perfect Blend
            </h1>
            <p class="text-sm sm:text-base text-brand-coffeeMuted">
                Choose your base and sweetness level to see your custom creation come to life instantly.
            </p>
        </div>

        <!-- Elevate with Premium Add-ons Top Grid (Gambar 4.3) -->
        <div class="space-y-4">
            <div class="text-center">
                <span class="text-xs font-bold uppercase tracking-wider text-brand-caramel">CUSTOMIZE YOUR EXPERIENCE</span>
                <h3 class="font-serif text-xl font-bold text-brand-coffee">Elevate with Premium Add-ons</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <div class="bg-white p-5 rounded-3xl border border-brand-latte/60 shadow-soft flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                        🍯
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-serif font-bold text-brand-coffee text-base">Wild Honey Drizzle</h4>
                            <span class="text-brand-caramel font-bold text-xs">+Rp 3.000</span>
                        </div>
                        <p class="text-xs text-brand-coffeeMuted mt-0.5">Pure organic wildflower honey for a smooth floral note.</p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-3xl border border-brand-latte/60 shadow-soft flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100/60 text-amber-700 flex items-center justify-center text-xl flex-shrink-0">
                        🍮
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-serif font-bold text-brand-coffee text-base">Extra Caramel Sauce</h4>
                            <span class="text-brand-caramel font-bold text-xs">+Rp 2.000</span>
                        </div>
                        <p class="text-xs text-brand-coffeeMuted mt-0.5">Rich, golden caramel sauce with a delicate savory touch.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Studio Interactive Canvas (Gambar 4.3) -->
        <div class="bg-white rounded-3xl border border-brand-latte/60 shadow-warm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 p-6 sm:p-10 lg:p-12 items-center">

                <!-- Left Column: Studio Controls -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Step 1: Select Base -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand-coffee text-white text-xs font-bold flex items-center justify-center">1</span>
                            <h3 class="font-serif text-lg font-bold text-brand-coffee">Select Base</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <template x-for="(bp, index) in baseProducts" :key="bp.id">
                                <button type="button" @click="selectedBase = index" :class="selectedBase === index ? 'border-brand-caramel bg-brand-ivory/60 ring-2 ring-brand-caramel/20' : 'border-brand-latte/60 bg-white hover:border-brand-latte'" class="p-4 rounded-2xl border text-left transition-all duration-200 flex items-center gap-3">
                                    <img :src="bp.image" class="w-12 h-12 rounded-xl object-cover">
                                    <div class="flex-1">
                                        <p class="font-bold text-xs text-brand-coffee" x-text="bp.name"></p>
                                        <p class="text-[11px] font-bold text-brand-caramel" x-text="formatRupiah(bp.price)"></p>
                                    </div>
                                    <div x-show="selectedBase === index" class="w-5 h-5 rounded-full bg-brand-caramel text-white flex items-center justify-center text-[10px]">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Step 2: Sweetness Level -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand-coffee text-white text-xs font-bold flex items-center justify-center">2</span>
                            <h3 class="font-serif text-lg font-bold text-brand-coffee">Sweetness Level</h3>
                        </div>

                        <div class="grid grid-cols-3 gap-3">
                            <button type="button" @click="sweetness = 'Less Sweet'" :class="sweetness === 'Less Sweet' ? 'bg-brand-coffee text-white shadow-soft' : 'bg-brand-ivory text-brand-coffee hover:bg-brand-latte/50'" class="p-3.5 rounded-2xl text-xs font-bold text-center border border-brand-latte/40 transition-all">
                                Less Sweet
                                <span class="block text-[10px] font-normal opacity-80 mt-0.5">50% Sugar</span>
                            </button>
                            <button type="button" @click="sweetness = 'Regular'" :class="sweetness === 'Regular' ? 'bg-brand-coffee text-white shadow-soft' : 'bg-brand-ivory text-brand-coffee hover:bg-brand-latte/50'" class="p-3.5 rounded-2xl text-xs font-bold text-center border border-brand-latte/40 transition-all">
                                Regular
                                <span class="block text-[10px] font-normal opacity-80 mt-0.5">Standard 100%</span>
                            </button>
                            <button type="button" @click="sweetness = 'Extra Sweet'" :class="sweetness === 'Extra Sweet' ? 'bg-brand-coffee text-white shadow-soft' : 'bg-brand-ivory text-brand-coffee hover:bg-brand-latte/50'" class="p-3.5 rounded-2xl text-xs font-bold text-center border border-brand-latte/40 transition-all">
                                Extra Sweet
                                <span class="block text-[10px] font-bold text-brand-amber mt-0.5">+Rp 500</span>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Add-ons -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-brand-coffee text-white text-xs font-bold flex items-center justify-center">3</span>
                            <h3 class="font-serif text-lg font-bold text-brand-coffee">Artisanal Toppings & Add-ons</h3>
                        </div>

                        <div class="space-y-2">
                            <template x-for="ad in addons" :key="ad.id">
                                <label class="flex items-center justify-between p-3 rounded-2xl bg-brand-ivory/50 border border-brand-latte/60 hover:bg-brand-ivory cursor-pointer transition-colors">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" :value="ad.id" x-model="selectedAddons" class="rounded border-brand-latte text-brand-caramel focus:ring-brand-caramel">
                                        <div>
                                            <span class="font-bold text-xs text-brand-coffee" x-text="ad.name"></span>
                                            <span class="text-[10px] text-brand-coffeeMuted block" x-text="ad.description"></span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-brand-caramel" x-text="'+' + formatRupiah(ad.price)"></span>
                                </label>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Live Visual Creation Card (Gambar 4.3) -->
                <div class="lg:col-span-5">
                    <div class="bg-gradient-to-b from-brand-ivory to-brand-cream rounded-3xl p-6 sm:p-8 border border-brand-latte/70 shadow-soft text-center space-y-6">
                        <span class="inline-block px-3 py-1 bg-brand-caramel/10 text-brand-caramel rounded-full text-[10px] font-bold uppercase tracking-wider">
                            Real-time Creation
                        </span>

                        <!-- Dynamic Visual Canvas -->
                        <div class="relative w-48 h-48 mx-auto rounded-3xl overflow-hidden shadow-warm border-4 border-white bg-white">
                            <img :src="currentBase().image" class="w-full h-full object-cover transition-all duration-500">
                            <!-- Overlay Tag for sweetness -->
                            <div class="absolute bottom-2 left-2 right-2 bg-brand-coffee/80 backdrop-blur-sm text-white py-1 px-2 rounded-xl text-[10px] font-semibold">
                                <span x-text="sweetness"></span> • <span x-text="selectedAddons.length + ' Add-ons'"></span>
                            </div>
                        </div>

                        <!-- Summary info -->
                        <div class="space-y-2">
                            <h4 class="font-serif text-2xl font-bold text-brand-coffee" x-text="'Custom ' + currentBase().name"></h4>
                            <p class="text-xs text-brand-coffeeMuted leading-relaxed max-w-xs mx-auto" x-text="currentBase().tagline"></p>
                        </div>

                        <!-- Price calculation -->
                        <div class="p-4 rounded-2xl bg-white border border-brand-latte/60 flex items-center justify-between">
                            <span class="text-xs font-bold text-brand-coffeeMuted">Estimated Price:</span>
                            <span class="font-serif text-2xl font-bold text-brand-caramel" x-text="formatRupiah(totalPrice())"></span>
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('custom.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="base_id" :value="currentBase().id">
                            <input type="hidden" name="sweetness" :value="sweetness">
                            <template x-for="adId in selectedAddons" :key="adId">
                                <input type="hidden" name="addons[]" :value="adId">
                            </template>
                            <input type="hidden" name="quantity" :value="qty">

                            <button type="submit" class="w-full py-4 rounded-full bg-brand-coffee text-white font-bold text-sm hover:bg-brand-coffeeLight hover:shadow-warm transition-all duration-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-plus text-xs"></i>
                                <span>Add Custom Treat</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection


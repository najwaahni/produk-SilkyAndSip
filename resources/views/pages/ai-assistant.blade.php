@extends('layouts.app')

@section('title', 'Taste Architect AI - SILKY & SIP | Smart Pairing Assistant')

@section('content')
<div class="py-12 bg-pattern min-h-screen" x-data="{
    messages: [
        {
            sender: 'ai',
            text: 'Welcome to SILKY & SIP! I\'m SILKY AI, your personal taste curator. Are you looking for a rich morning roast, a velvety caramel drizzle, or perhaps an artisan honey bundle? Tell me what you\'re craving!',
            products: []
        }
    ],
    userInput: '',
    isLoading: false,
    sweetnessLevel: 'Balanced',
    coffeeIntensity: 'Balanced',
    budgetRange: 25000,

    sendPrompt(promptText) {
        this.userInput = promptText;
        this.sendMessage();
    },

    async sendMessage() {
        if (!this.userInput.trim() || this.isLoading) return;

        const userMsg = this.userInput.trim();
        this.messages.push({
            sender: 'user',
            text: userMsg,
            products: []
        });
        this.userInput = '';
        this.isLoading = true;

        this.$nextTick(() => {
            this.scrollToBottom();
        });

        try {
            const response = await fetch('{{ route('ai.chat') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: userMsg,
                    sweetness: this.sweetnessLevel,
                    coffee: this.coffeeIntensity,
                    budget: this.budgetRange
                })
            });

            const data = await response.json();
            this.messages.push({
                sender: 'ai',
                text: data.reply,
                products: data.products || []
            });
        } catch (err) {
            this.messages.push({
                sender: 'ai',
                text: 'Maaf, terjadi gangguan pada koneksi AI. Namun kami sangat merekomendasikan Morning Indulgence Bundle kami yang lezat!',
                products: []
            });
        } finally {
            this.isLoading = false;
            this.$nextTick(() => {
                this.scrollToBottom();
            });
        }
    },

    scrollToBottom() {
        const box = document.getElementById('chat-messages-container');
        if (box) {
            box.scrollTop = box.scrollHeight;
        }
    },

    formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Page Header (Gambar 4.5) -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-brand-caramel block">Intelligent Curator</span>
            <h1 class="font-serif text-4xl sm:text-5xl font-bold text-brand-coffee">
                Your Personal Taste Architect
            </h1>
            <p class="text-sm sm:text-base text-brand-coffeeMuted">
                Curating bespoke coffee and silky caramel pairings tailored to your exact palate, mood, and budget.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Left Panel: Taste Navigator & Palate Calibration (Gambar 4.5) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Quick Prompts Box -->
                <div class="bg-white p-6 rounded-3xl border border-brand-latte/60 shadow-soft space-y-4">
                    <div class="space-y-1">
                        <h3 class="font-serif text-lg font-bold text-brand-coffee flex items-center gap-2">
                            <i class="fa-solid fa-compass text-brand-caramel"></i>
                            <span>Taste Navigator</span>
                        </h3>
                        <p class="text-xs text-brand-coffeeMuted">
                            Quick prompts to discover artisanal recommendations perfectly suited to your mood:
                        </p>
                    </div>

                    <div class="space-y-2">
                        <button type="button" @click="sendPrompt('Rekomendasi dessert manis creamy yang lumer di lidah')" class="w-full text-left p-3 rounded-2xl bg-brand-ivory/60 hover:bg-brand-ivory border border-brand-latte/40 transition-all text-xs flex items-center justify-between group">
                            <span class="font-semibold text-brand-coffee group-hover:text-brand-caramel">🍯 Sweet & Creamy Treat</span>
                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-coffeeMuted group-hover:translate-x-1 transition-transform"></i>
                        </button>

                        <button type="button" @click="sendPrompt('Saya butuh kopi yang kuat dengan sensasi manis karamel')" class="w-full text-left p-3 rounded-2xl bg-brand-ivory/60 hover:bg-brand-ivory border border-brand-latte/40 transition-all text-xs flex items-center justify-between group">
                            <span class="font-semibold text-brand-coffee group-hover:text-brand-caramel">☕ Bold Espresso & Caramel</span>
                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-coffeeMuted group-hover:translate-x-1 transition-transform"></i>
                        </button>

                        <button type="button" @click="sendPrompt('Apa paket bundling paling hemat untuk berdua?')" class="w-full text-left p-3 rounded-2xl bg-brand-ivory/60 hover:bg-brand-ivory border border-brand-latte/40 transition-all text-xs flex items-center justify-between group">
                            <span class="font-semibold text-brand-coffee group-hover:text-brand-caramel">✨ Best Bundles & Promos</span>
                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-coffeeMuted group-hover:translate-x-1 transition-transform"></i>
                        </button>

                        <button type="button" @click="sendPrompt('Rekomendasi menu dengan sentuhan madu organik alami')" class="w-full text-left p-3 rounded-2xl bg-brand-ivory/60 hover:bg-brand-ivory border border-brand-latte/40 transition-all text-xs flex items-center justify-between group">
                            <span class="font-semibold text-brand-coffee group-hover:text-brand-caramel">🐝 Artisan Honey Pairings</span>
                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-coffeeMuted group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>

                <!-- Palate Calibration Sliders -->
                <div class="bg-white p-6 rounded-3xl border border-brand-latte/60 shadow-soft space-y-5">
                    <div class="space-y-1">
                        <h3 class="font-serif text-lg font-bold text-brand-coffee flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-brand-caramel"></i>
                            <span>Palate Calibration</span>
                        </h3>
                        <p class="text-xs text-brand-coffeeMuted">Sesuaikan profil rasa yang Anda inginkan:</p>
                    </div>

                    <!-- Sweetness Level -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-brand-coffee">Sweetness:</span>
                            <span class="text-brand-caramel" x-text="sweetnessLevel"></span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" @click="sweetnessLevel = 'Less Sweet'" :class="sweetnessLevel === 'Less Sweet' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 text-[11px] rounded-xl border border-brand-latte/50 transition-all">
                                Less
                            </button>
                            <button type="button" @click="sweetnessLevel = 'Balanced'" :class="sweetnessLevel === 'Balanced' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 text-[11px] rounded-xl border border-brand-latte/50 transition-all">
                                Balanced
                            </button>
                            <button type="button" @click="sweetnessLevel = 'Extra Sweet'" :class="sweetnessLevel === 'Extra Sweet' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 text-[11px] rounded-xl border border-brand-latte/50 transition-all">
                                Extra
                            </button>
                        </div>
                    </div>

                    <!-- Coffee Intensity -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-brand-coffee">Coffee Intensity:</span>
                            <span class="text-brand-caramel" x-text="coffeeIntensity"></span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" @click="coffeeIntensity = 'Mild'" :class="coffeeIntensity === 'Mild' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 text-[11px] rounded-xl border border-brand-latte/50 transition-all">
                                Mild
                            </button>
                            <button type="button" @click="coffeeIntensity = 'Balanced'" :class="coffeeIntensity === 'Balanced' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 text-[11px] rounded-xl border border-brand-latte/50 transition-all">
                                Balanced
                            </button>
                            <button type="button" @click="coffeeIntensity = 'Bold'" :class="coffeeIntensity === 'Bold' ? 'bg-brand-coffee text-white font-bold' : 'bg-brand-ivory text-brand-coffee'" class="py-2 text-[11px] rounded-xl border border-brand-latte/50 transition-all">
                                Bold
                            </button>
                        </div>
                    </div>

                    <!-- Budget Range -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-brand-coffee">Anggaran Maksimal:</span>
                            <span class="text-brand-caramel" x-text="formatRupiah(budgetRange)"></span>
                        </div>
                        <input type="range" min="12000" max="40000" step="1000" x-model.number="budgetRange" class="w-full accent-brand-caramel cursor-pointer">
                        <div class="flex justify-between text-[10px] text-brand-coffeeMuted font-medium">
                            <span>Rp 12k</span>
                            <span>Rp 25k</span>
                            <span>Rp 40k</span>
                        </div>
                    </div>

                    <button type="button" @click="sendPrompt(`Rekomendasikan menu untuk saya dengan kemanisan ${sweetnessLevel}, kopi ${coffeeIntensity}, budget di bawah ${formatRupiah(budgetRange)}`)" class="w-full py-2.5 rounded-full bg-brand-ivory border border-brand-caramel text-brand-caramel font-bold text-xs hover:bg-brand-caramel hover:text-white transition-all">
                        <i class="fa-solid fa-wand-magic-sparkles mr-1.5"></i>Terapkan Kalibrasi ke AI
                    </button>
                </div>

                <!-- Seasonal Bundle Recommendation Card (Gambar 4.5) -->
                @if($bundle)
                    <div class="bg-gradient-to-br from-brand-coffee to-brand-coffeeLight text-white p-6 rounded-3xl shadow-warm border border-brand-coffeeLight space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 bg-brand-caramel text-white text-[10px] font-bold rounded-full uppercase tracking-wider">
                                Seasonal Bundle
                            </span>
                            <span class="text-brand-amber font-bold text-sm">{{ $bundle->formatted_price }}</span>
                        </div>
                        <h4 class="font-serif text-xl font-bold">{{ $bundle->name }}</h4>
                        <p class="text-xs text-brand-cream/80 leading-relaxed">
                            Single origin espresso whipped over creamy pudding. Pasangan paling sempurna untuk menikmati sore hari.
                        </p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $bundle->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="sweetness" value="Regular">
                            <button type="submit" class="w-full py-3 rounded-full bg-white text-brand-coffee font-bold text-xs hover:bg-brand-ivory transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-plus text-[10px]"></i>
                                <span>Add Bundle</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Right Panel: Conversation Room with SILKY Assistant (Gambar 4.5) -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl border border-brand-latte/60 shadow-warm flex flex-col h-[700px] overflow-hidden">

                    <!-- Chat Header -->
                    <div class="p-5 border-b border-brand-latte/60 bg-brand-cream/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-brand-caramel to-brand-coffee text-white flex items-center justify-center shadow-sm font-bold text-sm">
                                AI
                            </div>
                            <div>
                                <h3 class="font-serif font-bold text-base text-brand-coffee">SILKY Assistant</h3>
                                <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Online & Ready to brew
                                </p>
                            </div>
                        </div>

                        <button type="button" @click="messages = [messages[0]]" class="text-xs font-semibold text-brand-coffeeMuted hover:text-brand-coffee px-3 py-1.5 rounded-full hover:bg-brand-ivory transition-colors">
                            <i class="fa-solid fa-rotate-right mr-1"></i>Reset Chat
                        </button>
                    </div>

                    <!-- Chat Messages Stream -->
                    <div id="chat-messages-container" class="flex-1 p-6 overflow-y-auto space-y-4 bg-[#FAF8F5]">
                        <template x-for="(msg, i) in messages" :key="i">
                            <div class="space-y-3">
                                <!-- User Bubble -->
                                <div x-show="msg.sender === 'user'" class="flex justify-end">
                                    <div class="max-w-[80%] bg-brand-coffee text-white p-4 rounded-3xl rounded-tr-sm text-xs leading-relaxed shadow-sm">
                                        <p x-text="msg.text"></p>
                                    </div>
                                </div>

                                <!-- AI Bubble -->
                                <div x-show="msg.sender === 'ai'" class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand-caramel text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-1">
                                        AI
                                    </div>
                                    <div class="max-w-[85%] space-y-3">
                                        <div class="bg-white p-4 rounded-3xl rounded-tl-sm border border-brand-latte/60 text-xs text-brand-coffee leading-relaxed shadow-sm">
                                            <p class="whitespace-pre-line" x-text="msg.text"></p>
                                        </div>

                                        <!-- Embedded Recommended Product Cards in Chat Bubble -->
                                        <div x-show="msg.products && msg.products.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                                            <template x-for="p in msg.products" :key="p.id">
                                                <div class="bg-white rounded-2xl border border-brand-latte/80 p-3 shadow-soft space-y-2">
                                                    <div class="aspect-video rounded-xl overflow-hidden bg-brand-ivory">
                                                        <img :src="p.image" class="w-full h-full object-cover">
                                                    </div>
                                                    <div>
                                                        <h5 class="font-serif font-bold text-xs text-brand-coffee" x-text="p.name"></h5>
                                                        <p class="text-[11px] font-bold text-brand-caramel" x-text="p.formatted_price"></p>
                                                    </div>
                                                    <form action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" :value="p.id">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="sweetness" value="Regular">
                                                        <button type="submit" class="w-full py-1.5 rounded-xl bg-brand-coffee text-white text-[10px] font-bold hover:bg-brand-coffeeLight transition-colors">
                                                            + Add to Cart
                                                        </button>
                                                    </form>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Typing Loading Indicator -->
                        <div x-show="isLoading" class="flex items-center gap-2 text-xs text-brand-coffeeMuted italic pl-11">
                            <span class="w-2 h-2 rounded-full bg-brand-caramel animate-bounce" style="animation-delay: 0ms;"></span>
                            <span class="w-2 h-2 rounded-full bg-brand-caramel animate-bounce" style="animation-delay: 150ms;"></span>
                            <span class="w-2 h-2 rounded-full bg-brand-caramel animate-bounce" style="animation-delay: 300ms;"></span>
                            <span class="ml-1">SILKY AI sedang meracik rekomendasi...</span>
                        </div>
                    </div>

                    <!-- Chat Input Area -->
                    <div class="p-4 bg-white border-t border-brand-latte/60">
                        <form @submit.prevent="sendMessage()" class="flex items-center gap-2">
                            <input type="text" x-model="userInput" placeholder="Ask anything about our menu, flavor pairings, or dietary needs..." class="flex-1 px-5 py-3.5 text-xs bg-brand-ivory rounded-full border border-brand-latte/60 focus:outline-none focus:border-brand-caramel focus:bg-white text-brand-coffee placeholder:text-brand-coffeeMuted/60 transition-all">
                            <button type="submit" :disabled="isLoading || !userInput.trim()" class="w-12 h-12 rounded-full bg-brand-coffee text-white flex items-center justify-center hover:bg-brand-coffeeLight disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-soft flex-shrink-0">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection

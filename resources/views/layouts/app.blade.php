<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SILKY & SIP - Artisanal Indulgence | Silky Pudding & Coffee Dalgona')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            cream: '#FAF7F2',
                            ivory: '#F4EFEA',
                            latte: '#E8DEC8',
                            caramel: '#C67D38',
                            caramelDark: '#9E5B20',
                            caramelLight: '#E8A363',
                            coffee: '#23150F',
                            coffeeLight: '#3D271D',
                            coffeeMuted: '#685348',
                            amber: '#DF9B52',
                        }
                    },
                    boxShadow: {
                        'soft': '0 8px 30px rgba(35, 21, 15, 0.06)',
                        'warm': '0 12px 35px rgba(198, 125, 56, 0.15)',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .bg-pattern {
            background-color: #FAF7F2;
            background-image: radial-gradient(#C67D38 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            background-opacity: 0.05;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FAF7F2] text-brand-coffee min-h-screen flex flex-col font-sans selection:bg-brand-caramel selection:text-white antialiased" x-data="{ mobileMenuOpen: false }">

    <!-- Top Announcement Bar -->
    <div class="bg-brand-coffee text-brand-cream/90 text-xs py-2 px-4 text-center font-medium tracking-wide flex justify-center items-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-brand-amber animate-pulse"></span>
        <span>✨ <strong>Promo Spesial:</strong> Dapatkan Potongan Rp 4.000 untuk Morning Indulgence Bundle & Gratis Ongkir min. belanja Rp 35.000!</span>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 bg-[#FAF7F2]/90 backdrop-blur-md border-b border-brand-latte/40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-brand-caramel to-brand-coffee flex items-center justify-center text-white shadow-warm group-hover:scale-105 transition-transform duration-300">
                        <i class="fa-solid fa-mug-saucer text-lg"></i>
                    </div>
                    <div>
                        <span class="font-serif text-2xl font-bold tracking-tight text-brand-coffee block leading-none">
                            SILKY & SIP
                        </span>
                        <span class="text-[10px] tracking-[0.25em] uppercase text-brand-caramel font-semibold block mt-0.5">
                            Artisanal Indulgence
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffee/80 hover:text-brand-coffee hover:bg-brand-ivory' }}">
                        Home
                    </a>
                    <a href="{{ route('shop.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-colors {{ request()->routeIs('shop.*') ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffee/80 hover:text-brand-coffee hover:bg-brand-ivory' }}">
                        Shop / Catalog
                    </a>
                    <a href="{{ route('custom.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-colors {{ request()->routeIs('custom.*') ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffee/80 hover:text-brand-coffee hover:bg-brand-ivory' }}">
                        <i class="fa-solid fa-wand-magic-sparkles text-brand-caramel mr-1.5"></i>Custom Studio
                    </a>
                    <a href="{{ route('ai.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-colors {{ request()->routeIs('ai.*') ? 'bg-brand-coffee text-white shadow-sm' : 'text-brand-coffee/80 hover:text-brand-coffee hover:bg-brand-ivory' }}">
                        <i class="fa-solid fa-robot text-brand-caramel mr-1.5"></i>AI Assistant
                    </a>
                </nav>

                <!-- Right Action Buttons -->
                <div class="flex items-center gap-3">
                    <!-- Cart Pill -->
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = array_sum(array_column($cartItems, 'quantity'));
                    @endphp
                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-white border border-brand-latte/60 shadow-sm text-brand-coffee hover:border-brand-caramel hover:shadow-warm transition-all duration-200">
                        <i class="fa-solid fa-bag-shopping text-brand-caramel"></i>
                        <span class="text-sm font-bold hidden sm:inline">Cart</span>
                        <span id="nav-cart-badge" class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-brand-caramel rounded-full {{ $cartCount > 0 ? '' : 'hidden' }}">
                            {{ $cartCount }}
                        </span>
                    </a>

                    <!-- Admin Portal Pill -->
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.index') }}" title="Kelola Pesanan" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-full text-brand-coffeeMuted hover:text-brand-coffee hover:bg-brand-ivory transition-colors">
                                <i class="fa-solid fa-clipboard-list"></i>
                                <span>Admin</span>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" title="Masuk Admin" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-full text-brand-coffeeMuted hover:text-brand-coffee hover:bg-brand-ivory transition-colors">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Admin Login</span>
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden w-10 h-10 rounded-xl bg-brand-ivory flex items-center justify-center text-brand-coffee focus:outline-none">
                        <i :class="mobileMenuOpen ? 'fa-solid fa-xmark text-lg' : 'fa-solid fa-bars text-lg'"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Dropdown -->
            <div x-show="mobileMenuOpen" x-cloak class="md:hidden py-4 border-t border-brand-latte/40 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('home') ? 'bg-brand-coffee text-white' : 'text-brand-coffee hover:bg-brand-ivory' }}">
                    Home
                </a>
                <a href="{{ route('shop.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('shop.*') ? 'bg-brand-coffee text-white' : 'text-brand-coffee hover:bg-brand-ivory' }}">
                    Shop / Catalog
                </a>
                <a href="{{ route('custom.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('custom.*') ? 'bg-brand-coffee text-white' : 'text-brand-coffee hover:bg-brand-ivory' }}">
                    <i class="fa-solid fa-wand-magic-sparkles text-brand-caramel mr-2"></i>Custom Studio
                </a>
                <a href="{{ route('ai.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('ai.*') ? 'bg-brand-coffee text-white' : 'text-brand-coffee hover:bg-brand-ivory' }}">
                    <i class="fa-solid fa-robot text-brand-caramel mr-2"></i>AI Assistant
                </a>
                <a href="{{ route('cart.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('cart.*') ? 'bg-brand-coffee text-white' : 'text-brand-coffee hover:bg-brand-ivory' }}">
                    <i class="fa-solid fa-bag-shopping text-brand-caramel mr-2"></i>Keranjang ({{ $cartCount }})
                </a>
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold text-brand-coffeeMuted hover:bg-brand-ivory">
                            <i class="fa-solid fa-clipboard-list mr-2"></i>Admin Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold text-brand-coffeeMuted hover:bg-brand-ivory">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i>Admin Login
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Flash Alerts -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-6 right-6 z-50 bg-brand-coffee text-brand-cream px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 border border-brand-amber/30 transition-all">
            <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                <i class="fa-solid fa-check"></i>
            </div>
            <div>
                <p class="text-sm font-semibold">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-brand-cream/60 hover:text-white ml-2">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-6 right-6 z-50 bg-rose-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 border border-rose-700">
            <i class="fa-solid fa-triangle-exclamation text-rose-300"></i>
            <p class="text-sm font-semibold">{{ session('error') }}</p>
            <button @click="show = false" class="text-white/60 hover:text-white ml-2">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-brand-coffee text-brand-cream pt-16 pb-12 border-t border-brand-coffeeLight">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-brand-cream/10">
                <!-- Col 1: Brand Info -->
                <div class="md:col-span-1 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-brand-caramel flex items-center justify-center text-white">
                            <i class="fa-solid fa-mug-saucer"></i>
                        </div>
                        <span class="font-serif text-2xl font-bold tracking-tight text-brand-cream">
                            SILKY & SIP
                        </span>
                    </div>
                    <p class="text-xs text-brand-cream/70 leading-relaxed">
                        Perpaduan lembut silky caramel pudding dan kesegaran whipped coffee dalgona artisan. Dirancang untuk momen nyaman dan memanjakan lidah Anda.
                    </p>
                    <div class="flex items-center gap-3 text-brand-amber">
                        <a href="#" class="w-8 h-8 rounded-full bg-brand-coffeeLight flex items-center justify-center hover:bg-brand-caramel hover:text-white transition-colors"><i class="fa-brands fa-instagram text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-brand-coffeeLight flex items-center justify-center hover:bg-brand-caramel hover:text-white transition-colors"><i class="fa-brands fa-tiktok text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-brand-coffeeLight flex items-center justify-center hover:bg-brand-caramel hover:text-white transition-colors"><i class="fa-brands fa-whatsapp text-sm"></i></a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-brand-amber mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-brand-cream/75">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-white transition-colors">Katalog Menu</a></li>
                        <li><a href="{{ route('custom.index') }}" class="hover:text-white transition-colors">Custom Treat Studio</a></li>
                        <li><a href="{{ route('ai.index') }}" class="hover:text-white transition-colors">AI Taste Architect</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors">Keranjang & Checkout</a></li>
                    </ul>
                </div>

                <!-- Col 3: Signature Creations -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-brand-amber mb-4">Menu Unggulan</h4>
                    <ul class="space-y-2 text-sm text-brand-cream/75">
                        <li>Silky Pudding Caramel (Rp 12.000)</li>
                        <li>Coffee Dalgona (Rp 15.000)</li>
                        <li>Bundling Package (Rp 25.000)</li>
                        <li>Wild Honey Drizzle (+Rp 2.000)</li>
                        <li>Extra Caramel Sauce (+Rp 2.000)</li>
                    </ul>
                </div>

                <!-- Col 4: Project Info -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-brand-amber mb-4">Informasi Tim</h4>
                    <p class="text-xs text-brand-cream/80 leading-relaxed">
                        <strong>Praktikum E-Commerce - Kelompok 4</strong><br>
                        Program Studi Manajemen Informatika<br>
                        Fakultas Ilmu Komputer<br>
                        Universitas Sriwijaya, 2026
                    </p>
                    <div class="pt-2">
                        <span class="inline-block px-3 py-1 bg-brand-coffeeLight rounded-full text-[11px] text-brand-amber">
                            Dosen: Iin Seprina, M.Kom.
                        </span>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-brand-cream/60 gap-4">
                <p>&copy; 2026 SILKY & SIP. All rights reserved. Crafted with care for E-Commerce Lab.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.index') }}" class="hover:text-white underline">Portal Admin</a>
                    <span>•</span>
                    <span>Laravel v12 + Tailwind CSS</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>


@extends('layouts.app')

@section('title', 'Admin Dashboard - SILKY & SIP')

@section('content')
<div class="py-10 bg-pattern min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-brand-latte/60">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-caramel block">Store Management</span>
                <h1 class="font-serif text-3xl font-bold text-brand-coffee">
                    Admin Order Dashboard
                </h1>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-full bg-white border border-brand-latte text-brand-coffee text-xs font-bold hover:bg-brand-ivory transition-colors">
                    Lihat Website
                </a>
            </div>
        </div>

        <!-- Metric Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-brand-latte/60 shadow-soft space-y-2">
                <p class="text-xs font-bold text-brand-coffeeMuted uppercase">Total Pesanan</p>
                <p class="font-serif text-3xl font-bold text-brand-coffee">{{ $totalOrders }}</p>
                <p class="text-[11px] text-emerald-600 font-semibold"><i class="fa-solid fa-arrow-up mr-1"></i>Transaksi Masuk</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-brand-latte/60 shadow-soft space-y-2">
                <p class="text-xs font-bold text-brand-coffeeMuted uppercase">Total Pendapatan</p>
                <p class="font-serif text-3xl font-bold text-brand-caramel">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-[11px] text-brand-coffeeMuted">Estimasi Omzet Penjualan</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-brand-latte/60 shadow-soft space-y-2">
                <p class="text-xs font-bold text-brand-coffeeMuted uppercase">Sedang Disiapkan</p>
                <p class="font-serif text-3xl font-bold text-amber-600">{{ $preparingOrders }}</p>
                <p class="text-[11px] text-amber-700 font-semibold">Perlu Diproses Barista</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-brand-latte/60 shadow-soft space-y-2">
                <p class="text-xs font-bold text-brand-coffeeMuted uppercase">Selesai / Terkirim</p>
                <p class="font-serif text-3xl font-bold text-emerald-600">{{ $completedOrders }}</p>
                <p class="text-[11px] text-emerald-700 font-semibold">Pesanan Tuntas</p>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-3xl border border-brand-latte/60 shadow-soft overflow-hidden">
            <div class="p-6 border-b border-brand-latte/40 flex flex-col sm:flex-row items-center justify-between gap-4">
                <h3 class="font-serif text-xl font-bold text-brand-coffee">Daftar Transaksi Pesanan</h3>

                <!-- Filter Status -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.index') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ empty($status) || $status === 'all' ? 'bg-brand-coffee text-white' : 'bg-brand-ivory text-brand-coffeeMuted' }}">
                        Semua
                    </a>
                    <a href="{{ route('admin.index', ['status' => 'preparing']) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ ($status ?? '') === 'preparing' ? 'bg-amber-600 text-white' : 'bg-brand-ivory text-brand-coffeeMuted' }}">
                        Preparing
                    </a>
                    <a href="{{ route('admin.index', ['status' => 'completed']) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ ($status ?? '') === 'completed' ? 'bg-emerald-600 text-white' : 'bg-brand-ivory text-brand-coffeeMuted' }}">
                        Completed
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-brand-ivory/60 text-brand-coffee font-bold border-b border-brand-latte/40 uppercase tracking-wider text-[11px]">
                        <tr>
                            <th class="py-4 px-6">No. Resi</th>
                            <th class="py-4 px-6">Pelanggan</th>
                            <th class="py-4 px-6">Detail Pesanan</th>
                            <th class="py-4 px-6">Metode</th>
                            <th class="py-4 px-6">Total</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-latte/30">
                        @forelse($orders as $order)
                            <tr class="hover:bg-brand-ivory/20 transition-colors">
                                <td class="py-4 px-6 font-mono font-bold text-brand-caramel">
                                    #{{ $order->order_number }}
                                    <span class="block text-[10px] text-brand-coffeeMuted font-sans font-normal">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-bold text-brand-coffee">{{ $order->customer_name }}</p>
                                    <p class="text-brand-coffeeMuted text-[11px]">{{ $order->whatsapp_number }}</p>
                                    <p class="text-brand-coffeeMuted text-[10px] line-clamp-1 max-w-xs">{{ $order->delivery_address }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="space-y-1 max-w-xs">
                                        @foreach($order->items as $it)
                                            <p class="text-brand-coffee font-medium">
                                                • {{ $it->product_name }} x{{ $it->quantity }}
                                                <span class="text-[10px] text-brand-coffeeMuted">({{ $it->sweetness ?? 'Regular' }})</span>
                                            </p>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-medium text-brand-coffee">
                                    {{ $order->payment_method_label }}
                                </td>
                                <td class="py-4 px-6 font-bold text-brand-coffee">
                                    {{ $order->formatted_total }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ $order->status === 'preparing' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $order->status === 'out_for_delivery' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status === 'pending' ? 'bg-gray-100 text-gray-800' : '' }}
                                    ">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Status Update Form -->
                                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()" class="text-[11px] font-semibold bg-brand-ivory border border-brand-latte rounded-xl py-1 px-2 focus:ring-0">
                                                <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                                <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>On Delivery</option>
                                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>

                                        <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="w-8 h-8 rounded-xl bg-brand-ivory text-brand-coffee hover:bg-brand-latte flex items-center justify-center" title="Cetak Invoice">
                                            <i class="fa-solid fa-receipt text-xs"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-brand-coffeeMuted">
                                    Belum ada transaksi pesanan yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="p-4 border-t border-brand-latte/40">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

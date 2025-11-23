{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Greeting -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
        <h1 class="text-4xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
            Selamat Datang, {{ auth()->user()->name }}! 👋
        </h1>
        <p class="text-lg text-gray-600 mt-3">
            Ini adalah dashboard admin Art Devata — pusat kendali bisnis wisata Anda.
        </p>
        <p class="text-sm text-gray-500 mt-2">
            {{ now()->format('l, d F Y') }} | Jam: <span id="clock">{{ now()->format('H:i:s') }}</span>
        </p>
    </div>

    <!-- Stats Cards — SUPER KEREN! -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Pendapatan (Order Selesai) -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Pendapatan</p>
                    <p class="text-4xl font-black mt-2">
                        Rp {{ number_format(\App\Models\Order::where('status', 'selesai')->sum('total_price')) }}
                    </p>
                    <p class="text-green-100 text-xs mt-3 opacity-90">
                        Dari {{ \App\Models\Order::where('status', 'selesai')->count() }} pesanan selesai
                    </p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                    <i class="fas fa-wallet text-4xl"></i>
                </div>
            </div>
        </div>

        <!-- Pesanan Baru -->
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Pesanan Baru</p>
                    <p class="text-4xl font-black mt-2">
                        {{ \App\Models\Order::where('status', 'baru')->count() }}
                    </p>
                    <p class="text-blue-100 text-xs mt-3 opacity-90">Menunggu konfirmasi</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                    <i class="fas fa-bell text-4xl"></i>
                </div>
            </div>
        </div>

        <!-- Sedang Diproses -->
        <div class="bg-gradient-to-br from-orange-500 to-amber-600 rounded-2xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Sedang Diproses</p>
                    <p class="text-4xl font-black mt-2">
                        {{ \App\Models\Order::where('status', 'dihubungi')->count() }}
                    </p>
                    <p class="text-orange-100 text-xs mt-3 opacity-90">Sudah dihubungi</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                    <i class="fas fa-headset text-4xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pelanggan -->
        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl shadow-2xl p-8 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Pelanggan</p>
                    <p class="text-4xl font-black mt-2">
                        {{ \App\Models\Order::distinct('phone')->count('phone') }}
                    </p>
                    <p class="text-purple-100 text-xs mt-3 opacity-90">Unik berdasarkan nomor WA</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                    <i class="fas fa-users text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Pendapatan Bulan Ini -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                <i class="fas fa-chart-line text-primary text-3xl"></i>
                Pendapatan Bulan Ini
            </h3>
            <div class="text-center">
                <p class="text-5xl font-black text-green-600">
                    Rp {{ number_format(\App\Models\Order::where('status', 'selesai')
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->sum('total_price')) }}
                </p>
                <p class="text-gray-600 mt-4 text-lg">
                    {{ now()->format('F Y') }}
                </p>
            </div>
        </div>

        <!-- Pesanan Terakhir -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                <i class="fas fa-clock text-warning text-3xl"></i>
                5 Pesanan Terakhir
            </h3>
            <div class="space-y-4">
                @forelse(\App\Models\Order::latest()->take(5)->get() as $order)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $order->name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->package_title }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-green-600">Rp {{ number_format($order->total_price) }}</p>
                        <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-8">Belum ada pesanan</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Motivasi -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl shadow-2xl p-10 text-white text-center">
        <h2 class="text-4xl font-black mb-4">Keep Going, {{ auth()->user()->name }}! 🔥</h2>
        <p class="text-xl opacity-90">Setiap pesanan adalah langkah menuju kesuksesan Art Devata!</p>
    </div>
</div>

<!-- Live Clock Script -->
<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection
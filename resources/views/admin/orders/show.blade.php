@extends('admin.layout')

@section('title', 'Detail Order #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-8 py-10 text-white">
            <h1 class="text-4xl font-bold">Detail Pesanan #{{ $order->id }}</h1>
            <p class="mt-2 text-lg opacity-90">
                Diterima: {{ $order->created_at->format('d F Y, H:i') }}
            </p>
        </div>

        <div class="p-8 space-y-8">
            <!-- Info Customer -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                        Data Pelanggan
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Nama</p>
                            <p class="text-lg font-semibold">{{ $order->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">WhatsApp</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone) }}" 
                               target="_blank" 
                               class="text-lg font-bold text-green-600 hover:underline flex items-center gap-2">
                                {{ $order->phone }}
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967..."/>
                                </svg>
                            </a>
                        </div>
                        @if($order->email)
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="text-lg">{{ $order->email }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bg-green-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 8a3 3 0 100-6 3 3 0 000 6zm-3 6a5 5 0 0110 0H4z"/>
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM2 10a8 8 0 1116 0 8 8 0 01-16 0z" clip-rule="evenodd"/>
                        </svg>
                        Detail Paket
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Paket</p>
                            <p class="text-xl font-bold text-purple-700">{{ $order->package_title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal</p>
                            <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($order->date)->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Harga Total</p>
                            <p class="text-3xl font-black text-green-600">
                                IDR {{ number_format($order->total_price) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan -->
            @if($order->notes)
            <div class="bg-blue-50 rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-3">Catatan Pelanggan</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $order->notes }}</p>
            </div>
            @endif

            <!-- Tombol Aksi -->
            <div class="flex justify-center gap-4 pt-6">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone) }}?text={{ urlencode("Halo {$order->name}! Terima kasih sudah memesan paket {$order->package_title}. Kami akan segera hubungi Anda ya!") }}"
                   target="_blank"
                   class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-105 transition">
                    Hubungi via WhatsApp
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="px-8 py-4 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-xl shadow-lg">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- resources/views/admin/packages/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Daftar Paket Tiket')

@section('content')
<div class="p-6 lg:p-10 max-w-7xl mx-auto">

    <!-- Header + Tombol Tambah -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-10">
        <div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Daftar Paket Tiket
            </h1>
            <p class="text-xl text-gray-600 mt-3">Kelola semua paket wisata Art Devata</p>
        </div>
        <a href="{{ route('admin.packages.create') }}"
           class="inline-flex items-center gap-3 px-8 py-5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-xl rounded-2xl shadow-2xl transform hover:scale-110 hover:-translate-y-1 transition-all duration-300">
            <i class="fas fa-plus-circle text-2xl"></i>
            Tambah Paket Baru
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-4xl mb-3 block"></i>
            <p class="text-2xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Grid Paket -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($packages as $p)
            <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 border border-gray-100">
                
                <!-- Gambar + Badge VIP -->
                <div class="relative overflow-hidden">
                    @if($p->image)
                        <img src="{{ asset('storage/' . $p->image) }}"
                             alt="Paket {{ $p->title }}"
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="bg-gradient-to-br from-gray-200 to-gray-300 h-64 flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-gray-400 opacity-50"></i>
                        </div>
                    @endif

                    <!-- Badge PALING LARIS -->
                    @if(str_contains(strtolower($p->title), 'vip') || str_contains(strtolower($p->title), 'premium'))
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-red-600 to-pink-600 text-white px-5 py-2 rounded-full font-bold text-sm shadow-2xl animate-pulse">
                            PALING LARIS
                        </div>
                    @endif

                    <!-- Overlay Hover -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-500 flex items-end p-6 opacity-0 group-hover:opacity-100">
                        <p class="text-white font-bold text-lg">Klik untuk mengelola</p>
                    </div>
                </div>

                <!-- Konten Card -->
                <div class="p-8">
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-3 line-clamp-2">
                        {{ $p->title }}
                    </h3>
                    
                    <div class="mb-6">
                        <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
                            Rp {{ number_format($p->price) }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">per orang</p>
                    </div>

                    <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed mb-8">
                        {{ $p->detail ?? 'Tidak ada deskripsi' }}
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('admin.packages.edit', $p->id) }}"
                           class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold text-center py-4 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>

                        <form action="{{ route('admin.packages.destroy', $p->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus paket \"{{ addslashes($p->title) }}\"?')"
                                    class="w-full bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-bold py-4 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-20">
                <div class="bg-gray-100 rounded-3xl p-16 max-w-md mx-auto">
                    <i class="fas fa-box-open text-8xl text-gray-300 mb-8"></i>
                    <h3 class="text-3xl font-bold text-gray-600 mb-4">Belum Ada Paket</h3>
                    <p class="text-gray-500 text-lg mb-10">Mulai tambahkan paket wisata pertama Anda sekarang!</p>
                    <a href="{{ route('admin.packages.create') }}"
                       class="inline-flex items-center gap-3 px-10 py-6 bg-gradient-to-r from-primary to-secondary text-white font-black text-2xl rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300">
                        <i class="fas fa-plus-circle text-3xl"></i>
                        Tambah Paket Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
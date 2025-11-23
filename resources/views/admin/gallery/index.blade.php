{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Galeri Foto')

@section('content')
<div class="p-6 lg:p-12 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
        <div>
            <h1 class="text-6xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Galeri Foto
            </h1>
            <p class="text-2xl text-gray-600 mt-4">Koleksi momen terbaik Art Devata</p>
            <p class="text-lg text-gray-500 mt-2">Total: <span class="font-bold text-primary">{{ $gallery->count() }}</span> gambar</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}"
           class="inline-flex items-center gap-4 px-10 py-6 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-black text-2xl rounded-3xl shadow-2xl transform hover:scale-110 hover:-translate-y-2 transition-all duration-300">
            <i class="fas fa-plus-circle text-4xl"></i>
            TAMBAH GAMBAR BARU
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Galeri Grid -->
    @if($gallery->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach($gallery as $g)
                <div class="group relative bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 border border-gray-100">
                    
                    <!-- Gambar -->
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('storage/' . $g->image) }}" 
                             alt="Galeri Art Devata"
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>

                    <!-- Overlay & Tombol Hapus -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/60 transition-all duration-500 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <form action="{{ route('admin.gallery.destroy', $g->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus gambar ini? Aksi tidak dapat dibatalkan!')"
                                    class="inline-flex items-center gap-4 px-10 py-5 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-black text-2xl rounded-2xl shadow-2xl transform hover:scale-110 transition-all duration-300">
                                <i class="fas fa-trash-alt text-3xl"></i>
                                HAPUS
                            </button>
                        </form>
                    </div>

                    <!-- Badge Urutan -->
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-gray-800 font-bold px-4 py-2 rounded-full shadow-lg text-sm">
                        #{{ $loop->iteration }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-32">
            <div class="max-w-2xl mx-auto">
                <i class="fas fa-images text-12xl text-gray-300 mb-10"></i>
                <h3 class="text-5xl font-black text-gray-600 mb-6">Galeri Masih Kosong</h3>
                <p class="text-2xl text-gray-500 mb-12">Belum ada gambar yang diupload. Mulai tambahkan foto terbaik Anda sekarang!</p>
                <a href="{{ route('admin.gallery.create') }}"
                   class="inline-flex items-center gap-6 px-16 py-10 bg-gradient-to-r from-primary to-secondary text-white font-black text-4xl rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-500">
                    <i class="fas fa-plus-circle text-5xl"></i>
                    TAMBAH GAMBAR PERTAMA
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
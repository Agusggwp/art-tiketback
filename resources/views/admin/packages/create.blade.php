{{-- resources/views/admin/packages/create.blade.php --}}
@extends('admin.layout')

@section('title', 'Tambah Paket Baru')

@section('content')
<div class="max-w-5xl mx-auto p-6 lg:p-10">

    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-6xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
            Tambah Paket Baru
        </h1>
        <p class="text-2xl text-gray-600">Buat paket wisata impian yang akan membuat pelanggan jatuh cinta</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data" class="space-y-12">
        @csrf

        <!-- Nama & Harga -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-crown text-white text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Nama Paket</h2>
                </div>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="w-full px-8 py-6 text-2xl font-bold border-2 border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('title') border-red-500 @enderror"
                       placeholder="Contoh: Paket Honeymoon VIP Bali" required>
                @error('title')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-dollar-sign text-white text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Harga Paket</h2>
                </div>
                <div class="relative">
                    <span class="absolute left-8 top-1/2 transform -translate-y-1/2 text-3xl font-black text-gray-400">Rp</span>
                    <input type="number" name="price" value="{{ old('price') }}" 
                           class="w-full pl-24 pr-8 py-6 text-4xl font-black border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('price') border-red-500 @enderror"
                           placeholder="25000000" required>
                </div>
                <p class="text-gray-600 mt-4 text-lg">Harga per orang • Tanpa titik atau koma</p>
                @error('price')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-file-alt text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Deskripsi Paket</h2>
            </div>
            <textarea name="description" rows="12"
                      class="w-full px-8 py-6 text-lg border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl resize-none @error('description') border-red-500 @enderror"
                      placeholder="Tulis semua fasilitas, itinerary, dan keunggulan paket ini... Contoh: 
• Tiket masuk ke 5 objek wisata premium
• Makan malam romantis di tepi pantai
• Foto profesional + drone
• Transportasi AC + driver pribadi">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Upload Gambar -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-camera text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Gambar Paket (Opsional)</h2>
            </div>

            <div class="border-4 border-dashed border-gray-300 rounded-3xl p-16 text-center hover:border-primary transition-all duration-300 bg-gray-50 hover:bg-gray-100">
                <i class="fas fa-cloud-upload-alt text-9xl text-gray-400 mb-8"></i>
                <h3 class="text-3xl font-bold text-gray-700 mb-4">Upload Gambar Paket</h3>
                <p class="text-lg text-gray-600 mb-8">Gambar berkualitas tinggi akan menarik lebih banyak pelanggan!</p>
                
                <input type="file" name="image" accept="image/*" 
                       class="block w-full text-xl text-gray-700 file:mr-6 file:py-6 file:px-12 file:rounded-full file:border-0 file:text-xl file:font-bold file:bg-gradient-to-r file:from-primary file:to-secondary file:text-white hover:file:from-secondary hover:file:to-primary cursor-pointer @error('image') border-red-500 @enderror">
                
                <div class="mt-8 text-left text-gray-600">
                    <p class="text-lg font-semibold mb-3">Tips Gambar Terbaik:</p>
                    <ul class="space-y-2 text-base">
                        <li>• Format: PNG, JPG, WebP</li>
                        <li>• Maksimal: 5MB</li>
                        <li>• Rekomendasi: 1200x800px atau 16:9</li>
                        <li>• Gunakan foto real (bukan AI)</li>
                    </ul>
                </div>
            </div>
            @error('image')
                <p class="text-red-500 text-lg mt-6 flex items-center gap-3 justify-center">
                    <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-10 mt-16">
            <button type="submit" 
                    class="inline-flex items-center gap-6 px-20 py-8 bg-gradient-to-r from-primary to-secondary text-white font-black text-4xl rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-110 hover:-translate-y-3 transition-all duration-500">
                <i class="fas fa-paper-plane text-5xl"></i>
                BUAT PAKET SEKARANG
            </button>

            <a href="{{ route('admin.packages.index') }}"
               class="inline-flex items-center gap-4 px-14 py-8 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold text-2xl rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-arrow-left text-3xl"></i>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
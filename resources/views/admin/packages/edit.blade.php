{{-- resources/views/admin/packages/edit.blade.php --}}
@extends('admin.layout')

@section('title', 'Edit Paket: ' . $package->title)

@section('content')
<div class="max-w-5xl mx-auto p-6 lg:p-10">

    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-5xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
            Edit Paket Wisata
        </h1>
        <p class="text-xl text-gray-600">Perbarui informasi paket "{{ $package->title }}" dengan mudah</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('admin.packages.update', $package->id) }}" 
          enctype="multipart/form-data" class="space-y-12">
        @csrf
        @method('PATCH')

        <!-- Nama & Harga -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-tag text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Nama Paket</h2>
                </div>
                <input type="text" name="title" value="{{ old('title', $package->title) }}" 
                       class="w-full px-8 py-6 text-2xl font-bold border-2 border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('title') border-red-500 @enderror"
                       placeholder="Contoh: Paket Honeymoon VIP" required>
                @error('title')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-dollar-sign text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Harga Paket</h2>
                </div>
                <div class="relative">
                    <span class="absolute left-8 top-1/2 transform -translate-y-1/2 text-3xl font-bold text-gray-400">Rp</span>
                    <input type="number" name="price" value="{{ old('price', $package->price) }}" 
                           class="w-full pl-20 pr-8 py-6 text-3xl font-black border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('price') border-red-500 @enderror"
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
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-align-left text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Deskripsi Paket</h2>
            </div>
            <textarea name="description" rows="10"
                      class="w-full px-8 py-6 text-lg border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl resize-none @error('description') border-red-500 @enderror"
                      placeholder="Tulis semua fasilitas, itinerary, dan keunggulan paket ini...">{{ old('description', $package->detail) }}</textarea>
            @error('description')
                <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Gambar Paket -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-image text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Gambar Paket</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Preview Gambar Saat Ini -->
                <div class="text-center">
                    <p class="text-xl font-semibold text-gray-700 mb-6">Gambar Saat Ini</p>
                    @if($package->image)
                        <div class="inline-block p-6 bg-gray-50 rounded-3xl shadow-2xl border-4 border-dashed border-gray-200">
                            <img src="{{ asset('storage/' . $package->image) }}" 
                                 alt="{{ $package->title }}" 
                                 class="h-80 w-full object-cover rounded-2xl shadow-xl">
                        </div>
                    @else
                        <div class="h-80 bg-gray-100 rounded-3xl flex items-center justify-center border-4 border-dashed border-gray-300">
                            <p class="text-gray-500 text-2xl">Belum ada gambar</p>
                        </div>
                    @endif
                </div>

                <!-- Upload Gambar Baru -->
                <div>
                    <p class="text-xl font-semibold text-gray-700 mb-6">Upload Gambar Baru (Opsional)</p>
                    <div class="border-4 border-dashed border-gray-300 rounded-3xl p-12 text-center hover:border-primary transition-all duration-300 bg-gray-50 hover:bg-gray-100">
                        <i class="fas fa-cloud-upload-alt text-8xl text-gray-400 mb-6"></i>
                        <input type="file" name="image" accept="image/*" 
                               class="block w-full text-lg text-gray-700 file:mr-6 file:py-6 file:px-10 file:rounded-full file:border-0 file:text-lg file:font-bold file:bg-gradient-to-r file:from-primary file:to-secondary file:text-white hover:file:from-secondary hover:file:to-primary cursor-pointer @error('image') border-red-500 @enderror">
                        <p class="text-gray-600 mt-6 text-lg">
                            Format: PNG, JPG, WebP • Maksimal 5MB • Rekomendasi: 1200x800px
                        </p>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-lg mt-6 flex items-center gap-3 justify-center">
                            <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-8 mt-16">
            <button type="submit" 
                    class="inline-flex items-center gap-5 px-16 py-7 bg-gradient-to-r from-primary to-secondary text-white font-black text-3xl rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-110 hover:-translate-y-2 transition-all duration-500">
                <i class="fas fa-save text-4xl"></i>
                UPDATE PAKET
            </button>

            <a href="{{ route('admin.packages.index') }}"
               class="inline-flex items-center gap-4 px-12 py-7 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold text-2xl rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-arrow-left text-3xl"></i>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
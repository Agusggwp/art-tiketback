{{-- resources/views/admin/settings/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Pengaturan Website')

@section('content')
<div class="max-w-5xl mx-auto p-6 lg:p-10">

    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
            Pengaturan Website
        </h1>
        <p class="text-xl text-gray-600">Atur identitas dan tampilan Art Devata Anda</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-2xl transform hover:scale-105 transition-all duration-300 text-center">
            <i class="fas fa-check-circle text-3xl mb-3"></i>
            <p class="text-xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf
        @method('PUT')

        <!-- Informasi Umum -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-info-circle text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Informasi Umum</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-3">
                        <i class="fas fa-building mr-2 text-primary"></i> Nama Tempat Wisata
                    </label>
                    <input type="text" name="name" value="{{ old('name', $setting['name']) }}"
                           class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md @error('name') border-red-500 @enderror" 
                           placeholder="Contoh: Art Devata Bali" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-3">
                        <i class="fas fa-quote-left mr-2 text-secondary"></i> Tagline
                    </label>
                    <input type="text" name="tagline" value="{{ old('tagline', $setting['tagline']) }}"
                           class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-secondary focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md @error('tagline') border-red-500 @enderror"
                           placeholder="Contoh: Liburan Impian di Pulau Dewata" required>
                    @error('tagline')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mt-8">
                <label class="block text-lg font-semibold text-gray-700 mb-3">
                    <i class="fas fa-align-left mr-2 text-accent"></i> Deskripsi Singkat
                </label>
                <textarea name="description" rows="6"
                          class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-accent focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md resize-none @error('description') border-red-500 @enderror"
                          placeholder="Ceritakan sedikit tentang Art Devata...">{{ old('description', $setting['description']) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Logo Upload -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-accent to-purple-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-image text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Logo Website</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <!-- Preview Logo Saat Ini -->
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-700 mb-6">Logo Saat Ini</p>
                    @if($setting['logo'])
                        <div class="inline-block p-6 bg-gray-50 rounded-3xl shadow-xl border-4 border-dashed border-gray-200">
                            <img src="{{ $setting['logo'] }}" alt="Logo Art Devata" class="h-48 object-contain mx-auto">
                        </div>
                    @else
                        <div class="h-48 bg-gray-100 rounded-3xl flex items-center justify-center border-4 border-dashed border-gray-300">
                            <p class="text-gray-500 text-xl">Belum ada logo</p>
                        </div>
                    @endif
                </div>

                <!-- Upload Logo Baru -->
                <div>
                    <p class="text-lg font-semibold text-gray-700 mb-6">Upload Logo Baru</p>
                    <div class="border-4 border-dashed border-gray-300 rounded-3xl p-10 text-center hover:border-primary transition-all duration-300 bg-gray-50 hover:bg-gray-100">
                        <i class="fas fa-cloud-upload-alt text-6xl text-gray-400 mb-6"></i>
                        <input type="file" name="logo" accept="image/*" 
                               class="block w-full text-lg text-gray-700 file:mr-4 file:py-4 file:px-8 file:rounded-full file:border-0 file:text-lg file:font-semibold file:bg-gradient-to-r file:from-primary file:to-secondary file:text-white hover:file:from-secondary hover:file:to-primary cursor-pointer @error('logo') border-red-500 @enderror">
                        <p class="text-sm text-gray-600 mt-4">
                            Format: PNG, JPG, WebP • Maksimal 2MB • Rekomendasi: transparan
                        </p>
                    </div>
                    @error('logo')
                        <p class="text-red-500 text-sm mt-4 flex items-center gap-2 justify-center">
                            <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-12">
            <button type="submit" 
                    class="inline-flex items-center gap-4 px-12 py-6 bg-gradient-to-r from-primary to-secondary text-white font-black text-2xl rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-500 hover:-translate-y-2">
                <i class="fas fa-save text-3xl"></i>
                SIMPAN SEMUA PENGATURAN
            </button>
        </div>
    </form>
</div>
@endsection
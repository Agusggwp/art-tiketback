{{-- resources/views/admin/testimonials/create.blade.php --}}
@extends('admin.layout')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="max-w-4xl mx-auto p-6 lg:p-12">

    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-6xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
            Tambah Testimoni
        </h1>
        <p class="text-2xl text-gray-600">Bangun kepercayaan pelanggan dengan testimoni asli!</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('admin.testimonials.store') }}" class="space-y-12">
        @csrf

        <!-- Card Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-12 border border-gray-100">
            <div class="flex items-center gap-6 mb-12">
                <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-amber-600 rounded-3xl flex items-center justify-center shadow-2xl">
                    <i class="fas fa-star text-white text-5xl"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-gray-800">Testimoni Pelanggan</h2>
                    <p class="text-xl text-gray-600 mt-2">Masukkan testimoni asli dari pelanggan yang puas</p>
                </div>
            </div>

            <!-- Nama Pelanggan -->
            <div class="mb-12">
                <label class="flex items-center gap-4 text-2xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-user text-primary text-3xl"></i>
                    Nama Pelanggan
                </label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full px-10 py-7 text-2xl border-2 border-gray-200 rounded-3xl focus:border-primary focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('name') border-red-500 @enderror"
                       placeholder="Contoh: Budi Santoso" required>
                @error('name')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Pesan Testimoni -->
            <div class="mb-12">
                <label class="flex items-center gap-4 text-2xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-quote-left text-secondary text-3xl"></i>
                    Pesan Testimoni
                </label>
                <textarea name="message" rows="10"
                          class="w-full px-10 py-8 text-xl border-2 border-gray-200 rounded-3xl focus:border-secondary focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl resize-none @error('message') border-red-500 @enderror"
                          placeholder="Contoh: 
'Pengalaman liburan terbaik seumur hidup! Pelayanan super ramah, semua sesuai ekspektasi. Pasti akan kembali lagi ke Art Devata!'">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Info Tips -->
            <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-3xl p-10 border border-yellow-200">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-4">
                    <i class="fas fa-lightbulb text-yellow-600 text-3xl"></i>
                    Tips Testimoni Terbaik
                </h3>
                <ul class="space-y-4 text-lg text-gray-700">
                    <li class="flex items-center gap-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        Gunakan testimoni asli dari pelanggan
                    </li>
                    <li class="flex items-center gap-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        Tambahkan nama lengkap & foto (jika ada)
                    </li>
                    <li class="flex items-center gap-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        Testimoni yang emosional lebih disukai
                    </li>
                    <li class="flex items-center gap-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        Maksimal 2-3 kalimat saja
                    </li>
                </ul>
            </div>

            <!-- Action Buttons — SUDAH DIPERBAIKI 100% -->
<!-- Action Buttons — UKURAN DIPERKECIL, LEBIH PROPORSIONAL & CANTIK -->
<div class="flex flex-col sm:flex-row justify-center gap-6 mt-16">
    <!-- Tombol Simpan (UTAMA) -->
    <button type="submit" 
            class="group inline-flex items-center justify-center gap-4 px-16 py-6 
                   bg-gradient-to-r from-primary to-secondary 
                   hover:from-secondary hover:to-primary 
                   text-white font-black text-2xl lg:text-3xl 
                   rounded-2xl shadow-2xl hover:shadow-3xl 
                   transform hover:scale-105 hover:-translate-y-2 
                   transition-all duration-400 
                   focus:outline-none focus:ring-4 focus:ring-primary/50">
        <i class="fas fa-paper-plane text-3xl lg:text-4xl group-hover:rotate-12 transition-transform duration-300"></i>
        SIMPAN TESTIMONI
    </button>

    <!-- Tombol Batal -->
    <a href="{{ route('admin.testimonials.index') }}"
       class="group inline-flex items-center justify-center gap-3 px-12 py-6 
              bg-gradient-to-r from-gray-500 to-gray-600 
              hover:from-gray-600 hover:to-gray-700 
              text-white font-bold text-xl lg:text-2xl 
              rounded-2xl shadow-2xl hover:shadow-3xl 
              transform hover:scale-105 
              transition-all duration-400">
        <i class="fas fa-arrow-left text-2xl lg:text-3xl group-hover:-translate-x-1 transition-transform duration-300"></i>
        Batal
    </a>
</div>
        </div>
    </form>
</div>
@endsection
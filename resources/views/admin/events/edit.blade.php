{{-- resources/views/admin/events/edit.blade.php --}}
@extends('admin.layout')

@section('title', 'Edit Event: ' . $event->title)

@section('content')
<div class="max-w-5xl mx-auto p-6 lg:p-12">

    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-6xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
            Edit Event
        </h1>
        <p class="text-2xl text-gray-600">Perbarui event spesial "{{ $event->title }}" dengan mudah</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('admin.events.update', $event->id) }}" 
          enctype="multipart/form-data" class="space-y-12">
        @csrf
        @method('PATCH')

        <!-- Judul Event -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-5 mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-heading text-white text-3xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gray-800">Judul Event</h2>
            </div>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" 
                   class="w-full px-8 py-7 text-3xl font-bold border-2 border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('title') border-red-500 @enderror"
                   placeholder="Contoh: Festival Budaya Bali 2025" required>
            @error('title')
                <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Tanggal Mulai & Selesai -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Tanggal Mulai -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex items-center gap-5 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-calendar-day text-white text-3xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-800">Tanggal Mulai</h2>
                </div>
                <input type="date" name="start_date"
                       value="{{ old('start_date', $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') : '') }}"
                       class="w-full px-8 py-7 text-2xl font-bold text-center border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('start_date') border-red-500 @enderror"
                       required>
                @error('start_date')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3 justify-center">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex items-center gap-5 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-calendar-check text-white text-3xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-800">Tanggal Selesai</h2>
                </div>
                <input type="date" name="end_date"
                       value="{{ old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') : '') }}"
                       class="w-full px-8 py-7 text-2xl font-bold text-center border-2 border-gray-200 rounded-2xl focus:border-red-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl @error('end_date') border-red-500 @enderror"
                       required>
                @error('end_date')
                    <p class="text-red-500 text-lg mt-4 flex items-center gap-3 justify-center">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-5 mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-align-left text-white text-3xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gray-800">Deskripsi Event</h2>
            </div>
            <textarea name="description" rows="12"
                      class="w-full px-8 py-7 text-lg border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:outline-none transition-all duration-300 shadow-lg hover:shadow-xl resize-none @error('description') border-red-500 @enderror"
                      placeholder="Ceritakan detail event ini... Fasilitas, lokasi, harga tiket, dan apa yang membuatnya spesial!">{{ old('description', $event->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-lg mt-4 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Gambar Event -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
            <div class="flex items-center gap-5 mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-image text-white text-3xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gray-800">Gambar Event</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Preview Gambar Saat Ini -->
                <div class="text-center">
                    <p class="text-2xl font-semibold text-gray-700 mb-6">Gambar Saat Ini</p>
                    @if($event->image)
                        <div class="inline-block p-8 bg-gray-50 rounded-3xl shadow-2xl border-4 border-dashed border-gray-200">
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="h-96 w-full object-cover rounded-2xl shadow-2xl">
                        </div>
                    @else
                        <div class="h-96 bg-gray-100 rounded-3xl flex items-center justify-center border-4 border-dashed border-gray-300">
                            <p class="text-gray-500 text-3xl font-bold">Belum ada gambar</p>
                        </div>
                    @endif
                </div>

                <!-- Upload Gambar Baru -->
                <div>
                    <p class="text-2xl font-semibold text-gray-700 mb-6">Upload Gambar Baru (Opsional)</p>
                    <div class="border-4 border-dashed border-gray-300 rounded-3xl p-16 text-center hover:border-primary transition-all duration-300 bg-gray-50 hover:bg-gray-100">
                        <i class="fas fa-cloud-upload-alt text-10xl text-gray-400 mb-8"></i>
                        <h3 class="text-3xl font-bold text-gray-700 mb-4">Klik untuk Upload</h3>
                        <p class="text-lg text-gray-600 mb-10">Gambar berkualitas tinggi akan menarik lebih banyak pengunjung!</p>
                        
                        <input type="file" name="image" accept="image/*" 
                               class="block w-full text-xl text-gray-700 file:mr-6 file:py-6 file:px-12 file:rounded-full file:border-0 file:text-xl file:font-bold file:bg-gradient-to-r file:from-primary file:to-secondary file:text-white hover:file:from-secondary hover:file:to-primary cursor-pointer @error('image') border-red-500 @enderror">
                        
                        <div class="mt-10 text-left text-gray-600">
                            <p class="text-lg font-semibold mb-4">Tips Gambar Terbaik:</p>
                            <ul class="space-y-3 text-base">
                                <li>• Format: PNG, JPG, WebP</li>
                                <li>• Maksimal: 5MB</li>
                                <li>• Rekomendasi: 1920x1080px atau 16:9</li>
                                <li>• Gunakan foto real & menarik</li>
                            </ul>
                        </div>
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
        <div class="flex justify-center gap-10 mt-16">
            <button type="submit" 
                    class="inline-flex items-center gap-6 px-20 py-8 bg-gradient-to-r from-primary to-secondary text-white font-black text-4xl rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-110 hover:-translate-y-3 transition-all duration-500">
                <i class="fas fa-save text-5xl"></i>
                UPDATE EVENT
            </button>

            <a href="{{ route('admin.events.index') }}"
               class="inline-flex items-center gap-5 px-16 py-8 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold text-3xl rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-arrow-left text-4xl"></i>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
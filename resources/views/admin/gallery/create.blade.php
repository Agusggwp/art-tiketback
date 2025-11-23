{{-- resources/views/admin/gallery/create.blade.php --}}
@extends('admin.layout')

@section('title', 'Tambah Gambar Galeri')

@section('content')
<div class="max-w-6xl mx-auto p-6 lg:p-12">

    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-6xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
            Tambah Gambar Galeri
        </h1>
        <p class="text-2xl text-gray-600">Perkaya koleksi foto Art Devata dengan gambar-gambar terbaik!</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Upload Area -->
    <div class="bg-white rounded-3xl shadow-2xl p-12 border border-gray-100">
        <div class="flex items-center gap-6 mb-10">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-secondary rounded-3xl flex items-center justify-center shadow-2xl">
                <i class="fas fa-images text-white text-5xl"></i>
            </div>
            <div>
                <h2 class="text-4xl font-bold text-gray-800">Upload Gambar Baru</h2>
                <p class="text-xl text-gray-600 mt-2">Gambar berkualitas tinggi = website semakin menarik!</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-10">
            @csrf

            <!-- Drag & Drop Area (HANYA VISUAL) -->
            <label for="image-input" class="block cursor-pointer">
                <div class="border-6 border-dashed border-gray-300 rounded-3xl p-20 text-center hover:border-primary transition-all duration-500 bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-100 hover:to-gray-200 group">
                    <div class="transform group-hover:scale-110 transition-all duration-500">
                        <i class="fas fa-cloud-upload-alt text-12xl text-gray-400 mb-10 group-hover:text-primary"></i>
                        <h3 class="text-4xl font-black text-gray-700 mb-6">Drag & Drop atau Klik di Sini</h3>
                        <p class="text-2xl text-gray-600">Pilih gambar untuk diupload</p>
                    </div>
                </div>
            </label>

            <!-- Input File (DISEMBUNYIKAN, TAPI TETAP FUNGSIONAL) -->
            <input type="file" name="image" id="image-input" accept="image/*" required class="hidden">

            <!-- Preview Gambar -->
            <div id="preview-container" class="mt-10 hidden text-center">
                <p class="text-2xl font-bold text-gray-700 mb-8">Preview Gambar:</p>
                <img id="preview-image" class="max-h-96 mx-auto rounded-3xl shadow-2xl border-4 border-gray-200">
                <p class="mt-6 text-lg text-gray-600">Gambar siap diupload!</p>
            </div>

            <!-- Tombol Upload (HANYA MUNCUL SETELAH PILIH GAMBAR) -->
            <div id="upload-button-container" class="hidden text-center mt-12">
                <button type="submit" 
                        class="inline-flex items-center gap-6 px-24 py-10 bg-gradient-to-r from-primary to-secondary text-white font-black text-5xl rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-500">
                    <i class="fas fa-cloud-upload-alt text-6xl"></i>
                    UPLOAD GAMBAR SEKARANG
                </button>
            </div>

            <!-- Info & Tips -->
            <div class="mt-12 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-10 border border-blue-200">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-4">
                    <i class="fas fa-lightbulb text-yellow-500 text-3xl"></i>
                    Tips Gambar Terbaik untuk Galeri
                </h3>
                <ul class="space-y-4 text-lg text-gray-700">
                    <li class="flex items-center gap-4"><i class="fas fa-check-circle text-green-600 text-xl"></i> Format: PNG, JPG, WebP</li>
                    <li class="flex items-center gap-4"><i class="fas fa-check-circle text-green-600 text-xl"></i> Maksimal: 5MB</li>
                    <li class="flex items-center gap-4"><i class="fas fa-check-circle text-green-600 text-xl"></i> Resolusi: 1920x1080px atau lebih</li>
                    <li class="flex items-center gap-4"><i class="fas fa-check-circle text-green-600 text-xl"></i> Gunakan foto real</li>
                </ul>
            </div>

            @error('image')
                <p class="text-red-500 text-2xl mt-6 flex items-center gap-4 justify-center">
                    <i class="fas fa-exclamation-triangle text-3xl"></i> {{ $message }}
                </p>
            @enderror
        </form>
    </div>
</div>

<!-- Script Preview + Tombol Upload -->
<script>
    const fileInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const uploadButtonContainer = document.getElementById('upload-button-container');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadButtonContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
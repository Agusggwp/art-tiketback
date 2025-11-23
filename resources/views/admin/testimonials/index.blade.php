{{-- resources/views/admin/testimonials/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Daftar Testimoni')

@section('content')
<div class="p-6 lg:p-12 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
        <div>
            <h1 class="text-6xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Daftar Testimoni
            </h1>
            <p class="text-2xl text-gray-600 mt-4">Kelola semua testimoni pelanggan Art Devata</p>
            <p class="text-lg text-gray-500 mt-2">
                Total: <span class="font-bold text-primary">{{ $testimonials->count() }}</span> testimoni
            </p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}"
           class="inline-flex items-center gap-4 px-10 py-6 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-black text-2xl rounded-3xl shadow-2xl transform hover:scale-110 hover:-translate-y-2 transition-all duration-300">
            <i class="fas fa-plus-circle text-4xl"></i>
            TAMBAH TESTIMONI BARU
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-6xl mb-4 block"></i>
            <p class="text-3xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Testimoni — SUPER MEWAH -->
    @if($testimonials->count() > 0)
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-primary to-secondary text-white">
                            <th class="px-10 py-8 text-left text-xl font-bold">No</th>
                            <th class="px-10 py-8 text-left text-xl font-bold">Nama Pelanggan</th>
                            <th class="px-10 py-8 text-left text-xl font-bold">Pesan Testimoni</th>
                            <th class="px-10 py-8 text-center text-xl font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($testimonials as $index => $t)
                            <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-300 group">
                                <!-- No -->
                                <td class="px-10 py-8 text-center">
                                    <span class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-primary to-secondary text-white font-black text-2xl rounded-full shadow-lg">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <!-- Nama -->
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-5">
                                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-amber-600 rounded-full flex items-center justify-center text-white font-black text-3xl shadow-2xl">
                                            {{ substr($t->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-800">{{ $t->name }}</h3>
                                            <p class="text-gray-500">Pelanggan Setia</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Pesan -->
                                <td class="px-10 py-8">
                                    <div class="max-w-2xl">
                                        <p class="text-lg text-gray-700 leading-relaxed italic">
                                            "{{ $t->message }}"
                                        </p>
                                        <div class="flex items-center gap-1 mt-4">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-yellow-500 text-xl"></i>
                                            @endfor
                                            <span class="ml-3 text-yellow-600 font-bold">5.0</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-10 py-8 text-center">
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus testimoni dari {{ addslashes($t->name) }}?')"
                                                class="inline-flex items-center gap-4 px-10 py-6 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-black text-2xl rounded-2xl shadow-2xl transform hover:scale-110 transition-all duration-300">
                                            <i class="fas fa-trash-alt text-3xl"></i>
                                            HAPUS
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-32">
            <div class="max-w-2xl mx-auto">
                <i class="fas fa-comment-slash text-12xl text-gray-300 mb-10"></i>
                <h3 class="text-5xl font-black text-gray-600 mb-6">Belum Ada Testimoni</h3>
                <p class="text-2xl text-gray-500 mb-12">Mulai tambahkan testimoni pertama dari pelanggan Anda!</p>
                <a href="{{ route('admin.testimonials.create') }}"
                   class="inline-flex items-center gap-6 px-16 py-10 bg-gradient-to-r from-primary to-secondary text-white font-black text-4xl rounded-3xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-500">
                    <i class="fas fa-plus-circle text-5xl"></i>
                    TAMBAH TESTIMONI PERTAMA
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
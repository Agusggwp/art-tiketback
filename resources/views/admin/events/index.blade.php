{{-- resources/views/admin/events/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Daftar Event')

@section('content')
<div class="p-6 lg:p-10 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
        <div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Daftar Event
            </h1>
            <p class="text-xl text-gray-600 mt-3">Kelola semua event spesial Art Devata</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center gap-3 px-8 py-5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-xl rounded-2xl shadow-2xl transform hover:scale-110 hover:-translate-y-1 transition-all duration-300">
            <i class="fas fa-plus-circle text-2xl"></i>
            Tambah Event Baru
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-10 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-check-circle text-5xl mb-4 block"></i>
            <p class="text-2xl font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Event — SUPER MEWAH -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-primary to-secondary text-white">
                        <th class="px-8 py-6 text-left text-lg font-bold">Gambar</th>
                        <th class="px-8 py-6 text-left text-lg font-bold">Judul Event</th>
                        <th class="px-8 py-6 text-left text-lg font-bold">Tanggal</th>
                        <th class="px-8 py-6 text-center text-lg font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $e)
                        <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-300 group">
                            <!-- GAMBAR -->
                            <td class="px-8 py-6">
                                <div class="relative">
                                    @if($e->image)
                                        <img src="{{ asset('storage/' . $e->image) }}"
                                             alt="{{ $e->title }}"
                                             class="w-32 h-24 object-cover rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-32 h-24 bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl flex items-center justify-center shadow-xl">
                                            <i class="fas fa-image text-4xl text-gray-400 opacity-50"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- JUDUL -->
                            <td class="px-8 py-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                    {{ $e->title }}
                                </h3>
                                <p class="text-gray-600 line-clamp-2">
                                    {{ $e->description ?? 'Tidak ada deskripsi' }}
                                </p>
                            </td>

                            <!-- TANGGAL -->
                            <td class="px-8 py-6">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-calendar-alt text-green-600 text-xl"></i>
                                        <span class="font-bold text-green-700">
                                            {{ $e->start_date ? \Carbon\Carbon::parse($e->start_date)->format('d M Y') : '-' }}
                                        </span>
                                    </div>
                                    @if($e->end_date && $e->end_date != $e->start_date)
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-calendar-check text-red-600 text-xl"></i>
                                            <span class="font-bold text-red-700">
                                                {{ \Carbon\Carbon::parse($e->end_date)->format('d M Y') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- AKSI -->
                            <td class="px-8 py-6 text-center">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('admin.events.edit', $e->id) }}"
                                       class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-edit text-xl"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.events.destroy', $e->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus event \"{{ addslashes($e->title) }}\"?')"
                                                class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-110 transition-all duration-300">
                                            <i class="fas fa-trash-alt text-xl"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-24">
                                <div class="max-w-md mx-auto">
                                    <i class="fas fa-calendar-times text-9xl text-gray-300 mb-8"></i>
                                    <h3 class="text-4xl font-bold text-gray-600 mb-4">Belum Ada Event</h3>
                                    <p class="text-xl text-gray-500 mb-10">Mulai buat event spesial pertama Anda sekarang!</p>
                                    <a href="{{ route('admin.events.create') }}"
                                       class="inline-flex items-center gap-4 px-12 py-6 bg-gradient-to-r from-primary to-secondary text-white font-black text-2xl rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-plus-circle text-3xl"></i>
                                        Tambah Event Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
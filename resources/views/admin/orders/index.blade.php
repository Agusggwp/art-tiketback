@extends('admin.layout')
@section('title', 'Daftar Pesanan')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Daftar Pesanan</h1>
            <p class="mt-2 text-sm text-gray-700">
                Total: <span class="font-bold text-indigo-600">{{ $orders->total() }}</span> pesanan
            </p>
        </div>
    </div>

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($orders as $index => $order)
                            <tr class="{{ $order->status == 'baru' ? 'bg-yellow-50' : ($order->status == 'dihubungi' ? 'bg-blue-50' : 'bg-green-50') }}">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                    {{ $orders->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-bold text-gray-900">{{ $order->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $order->phone }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-purple-700">
                                    {{ $order->package_title }}
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-green-600">
                                    Rp {{ number_format($order->total_price) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}
                                </td>
                                
                                {{-- UBAH STATUS LANGSUNG DARI TABEL --}}
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-xs font-bold rounded-full px-4 py-2 border-0 focus:ring-4 focus:ring-opacity-50 transition cursor-pointer
                                                    {{ $order->status == 'baru' ? 'bg-yellow-100 text-yellow-800 focus:ring-yellow-300' : 
                                                       ($order->status == 'dihubungi' ? 'bg-blue-100 text-blue-800 focus:ring-blue-300' : 
                                                       'bg-green-100 text-green-800 focus:ring-green-300') }}">
                                            <option value="baru" {{ $order->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                            <option value="dihubungi" {{ $order->status == 'dihubungi' ? 'selected' : '' }}>Sudah Dihubungi</option>
                                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>

                                <td class="px-6 py-4 text-right text-sm font-medium space-x-4">
                                    <a href="{{ route('admin.orders.show', $order) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 font-medium">Lihat</a>
                                    
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus pesanan ini?')" 
                                                class="text-red-600 hover:text-red-900 font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-20 text-center text-gray-500">
                                    <div class="text-2xl mb-4">Belum ada pesanan masuk</div>
                                    <p class="text-lg">Yuk promosi paket wisata Art Devata!</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- PAGINATION YANG PASTI JALAN DI LARAVEL 12 --}}
    <div class="mt-8 flex justify-center">
        {{ $orders->links('pagination::tailwind') }}
    </div>
</div>
@endsection
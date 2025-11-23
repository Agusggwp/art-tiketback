<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil dihapus');
    }

    // app/Http/Controllers/Admin/OrderAdminController.php
public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:baru,dihubungi,selesai'
    ]);

    $order->update(['status' => $request->status]);

    return back()->with('success', 'Status pesanan berhasil diubah!');
}
}
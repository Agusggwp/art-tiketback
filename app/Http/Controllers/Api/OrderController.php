<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'package_id' => 'nullable|integer',
            'package_title' => 'required|string',
            'package_price' => 'required|integer',
            'total_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::create($request->all());

        // Optional: Kirim notifikasi ke WhatsApp admin (nanti bisa pakai WhatsApp API)
        // $this->sendWhatsAppNotification($order);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dikirim! Kami akan segera menghubungi Anda.',
            'data' => $order
        ], 201);
    }

    // BONUS: Lihat semua order di admin (untuk nanti)
    public function index()
    {
        $orders = Order::latest()->get();
        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $logoPath = Setting::where('key', 'logo')->value('logo'); // ambil path logo dari kolom logo

        return response()->json([
            'success' => true,
            'data'    => [
                'name'        => $settings['name']        ?? 'Wisata Devata',
                'tagline'     => $settings['tagline']     ?? 'Keindahan Alam Bali',
                'description' => $settings['description'] ?? 'Selamat datang di destinasi terbaik',
                'logo'        => $logoPath 
                    ? asset('storage/' . $logoPath) 
                    : asset('images/default-logo.png'), // fallback kalau belum ada logo
            ],
            'message' => 'Pengaturan berhasil dimuat'
        ], 200);
    }
}
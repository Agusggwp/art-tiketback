<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingAdminController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $logo = Setting::where('key', 'logo')->first()?->logo;

        $setting = [
            'name'        => $settings['name']        ?? 'Nama Tempat Wisata',
            'tagline'     => $settings['tagline']     ?? 'Tagline Anda',
            'description' => $settings['description'] ?? 'Deskripsi singkat tempat wisata Anda.',
            'logo'        => $logo ? asset('storage/' . $logo) : null,
        ];

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'tagline'     => 'required|string|max:255',
            'description' => 'required|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048', // max 2MB
        ]);

        $data = $request->only(['name', 'tagline', 'description']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Upload Logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama kalau ada
            $oldLogo = Setting::where('key', 'logo')->first()?->logo;
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('logo')->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['logo' => $path]);
        }

        return back()->with('success', 'Pengaturan & Logo berhasil disimpan!');
    }
}
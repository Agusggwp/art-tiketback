<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PackageAdminController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048', // max 2MB
        ]);

        $data = $request->only(['title', 'price', 'description']);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create([
            'title'       => $data['title'],
            'name'        => $data['title'],
            'price'       => $data['price'],
            'detail'      => $data['description'],
            'image'       => $data['image'] ?? null,
            'slug'        => Str::slug($data['title']),
        ]);

        return redirect('/admin/packages')->with('success', 'Paket berhasil dibuat!');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $data = $request->only(['title', 'price', 'description']);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update([
            
            'name'        => $data['title'],
            'price'       => $data['price'],
            'detail'      => $data['description'],
            'image'       => $data['image'] ?? $package->image,
            'slug'        => Str::slug($data['title']),
        ]);

        return redirect('/admin/packages')->with('success', 'Paket berhasil diupdate!');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        // Hapus gambar dari storage
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return back()->with('success', 'Paket berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'image' => $path
        ]);

        return redirect('/admin/gallery')->with('success', 'Gambar ditambahkan!');
    }

    public function destroy($id)
    {
        $g = Gallery::findOrFail($id);

        Storage::disk('public')->delete($g->image);

        $g->delete();

        return back()->with('success', 'Gambar dihapus!');
    }
}

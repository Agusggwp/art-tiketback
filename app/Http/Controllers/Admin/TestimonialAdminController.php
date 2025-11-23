<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialAdminController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        Testimonial::create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        return redirect('/admin/testimonials')->with('success', 'Testimoni ditambahkan!');
    }

    public function destroy($id)
    {
        Testimonial::destroy($id);
        return back()->with('success', 'Testimoni dihapus!');
    }
}

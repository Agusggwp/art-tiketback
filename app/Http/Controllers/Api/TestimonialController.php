<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        try {
            $testimonials = Testimonial::select('name', 'message')
                                       ->inRandomOrder()
                                       ->limit(10)
                                       ->get()
                                       ->map(function ($t) {
                                           return [
                                               'name'    => $t->name,
                                               'message' => $t->message,
                                               'rating'  => 5, // karena tidak ada kolom rating, kasih default 5 bintang
                                               'image'   => null, // tidak ada kolom image, kasih null
                                           ];
                                       });

            return response()->json([
                'success' => true,
                'data'    => $testimonials
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat testimonial',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::select('id', 'caption', 'image')
                          ->orderBy('created_at', 'desc')
                          ->get()
                          ->map(function ($item) {
                              return [
                                  'id'      => $item->id,
                                  'caption' => $item->caption,
                                  'image'   => asset('storage/' . $item->image),
                              ];
                          });

        return response()->json([
            'success' => true,
            'data'    => $gallery
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::select('id', 'name as title', 'price', 'detail as description', 'image')
                           ->get()
                           ->map(function ($package) {
                               return [
                                   'id'          => $package->id,
                                   'title'       => $package->title,
                                   'price'       => (int) $package->price,
                                   'description' => $package->description,
                                   'image'       => $package->image 
                                       ? asset('storage/' . $package->image) 
                                       : null, // kirim URL lengkap atau null
                               ];
                           });

        return response()->json([
            'success' => true,
            'data'    => $packages
        ]);
    }
}
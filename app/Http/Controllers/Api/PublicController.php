<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\Transaction;

class PublicController extends Controller
{
    public function settings()
    {
        return response()->json(
            Setting::pluck('value', 'key')
        );
    }

    public function packages()
    {
        return response()->json(
            Package::where('active', 1)->get()
        );
    }

    public function packageDetail($slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();
        return response()->json($package);
    }

    public function events()
    {
        return response()->json(
            Event::orderBy('start_date', 'asc')->get()
        );
    }

    public function galleries()
    {
        return response()->json(
            Gallery::latest()->get()
        );
    }

    public function testimonials()
    {
        return response()->json(
            Testimonial::latest()->get()
        );
    }

    // GET /api/buy?package=vip&qty=1&name=Agus&email=a@mail.com
    public function buy(Request $req)
    {
        $slug = $req->query('package');
        $qty = (int) $req->query('qty', 1);
        $name = $req->query('name', 'Pembeli');
        $email = $req->query('email', '');

        if (!$slug) {
            return response()->json(['error' => 'Parameter package wajib'], 400);
        }

        $package = Package::where('slug', $slug)->first();
        if (!$package) {
            return response()->json(['error' => 'Package tidak ditemukan'], 404);
        }

        $total = $package->price * $qty;

        $trx = Transaction::create([
            'invoice'       => Transaction::generateInvoice(),
            'package_id'    => $package->id,
            'qty'           => $qty,
            'total_amount'  => $total,
            'buyer_name'    => $name,
            'buyer_email'   => $email,
            'status'        => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'invoice' => $trx->invoice,
            'total'   => $trx->total_amount
        ]);
    }
}

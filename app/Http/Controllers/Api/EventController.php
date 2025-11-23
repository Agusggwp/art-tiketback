<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        try {
            $events = Event::select('id', 'title', 'start_date', 'end_date', 'description', 'image')
                ->orderBy('start_date', 'desc')
                ->get()
                ->map(function ($event) {
                    return [
                        'id'          => $event->id,
                        'title'       => $event->title,
                        'start_date'  => $event->start_date ? Carbon::parse($event->start_date)->format('Y-m-d') : null,
                        'end_date'    => $event->end_date ? Carbon::parse($event->end_date)->format('Y-m-d') : null,
                        'description' => $event->description,
                        'image'       => $event->image ? asset('storage/' . $event->image) : null,
                    ];
                });

            return response()->json([
                'success' => true,
                'data'    => $events
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat event',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
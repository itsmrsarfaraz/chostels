<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Hostel;

class HostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::query()->withCount('rooms')->latest()->paginate(12);
        return view('seeker.hostels.index', compact('hostels'));
    }

    public function show(Hostel $hostel) {
        $hostel->load(['rooms' => function ($query) {
            $query->with(['beds' => function ($query) {
                $query->available();
                }]);
            },
            'facilities',
            'rules',
            'nearbyPlaces',
        ]);
        return view('seeker.hostels.show', compact('hostel'));
    }
}
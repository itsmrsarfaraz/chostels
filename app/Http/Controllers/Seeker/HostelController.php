<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Hostel;

class HostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::query()
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('seeker.hostels.index', compact('hostels'));
    }

    public function show(Hostel $hostel)
    {
        $hostel->load([
            'rooms.beds',
            'facilities',
            'rules',
            'nearbyPlaces',
        ]);

        return view('seeker.hostels.show', compact('hostel'));
    }
}
<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreHostelRequest;
use App\Http\Requests\Owner\UpdateHostelRequest;
use App\Models\Hostel;
use App\Services\Hostel\HostelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HostelController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $hostels = $user->hostels()->latest()->get();
        return view('owner.hostels.index', compact('hostels'));
    }

    public function create()
    {
        return view('owner.hostels.create');
    }

    public function store(StoreHostelRequest $request, HostelService $service) {
        $data = $request->validated();
        $user = Auth::user();
        $data['owner_id'] = $user->id;
        $hostel = $service->create($data);
        if ($request->hasFile('logo')) {
            $hostel->addMediaFromRequest('logo')->toMediaCollection('logo');
        }

        return redirect()->route('owner.hostels.index');
    }

    public function edit(Hostel $hostel)
    {
        Gate::authorize('update', $hostel);

        return view('owner.hostels.edit', compact('hostel'));
    }

    public function update(UpdateHostelRequest $request, Hostel $hostel, HostelService $service) {
        Gate::authorize('update', $hostel);
        $service->update($hostel, $request->validated());
        return redirect()->route('owner.hostels.index');
    }
    
}

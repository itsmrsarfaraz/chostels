<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteProfileRequest;
use App\Models\OwnerProfile;
use App\Models\SeekerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileCompletionController extends Controller
{
    public function create(): View
    {
        return view('profile.complete');
    }

    public function store(CompleteProfileRequest $request): RedirectResponse {
        $user = $request->user();

        if ($user->hasRole('owner')) {

            OwnerProfile::updateOrCreate(
                ['user_id' => $user->id],
                $request->validated()
            );
        }

        if ($user->hasRole('seeker')) {

            SeekerProfile::updateOrCreate(
                ['user_id' => $user->id],
                $request->validated()
            );
        }

        return redirect('/dashboard');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetPasswordController extends Controller
{
    public function create(User $user)
    {
        abort_unless(request()->hasValidSignature(), 403);
        return view('auth.onboarding.set-password', compact('user'));
    }

    public function store(SetPasswordRequest $request, User $user) {
        abort_unless(request()->hasValidSignature(), 403);

        $user->update([
            'password' => Hash::make(
                $request->password
            ),
            'password_set_at' => now(),
            'email_verified_at' => now(),
            'is_invited' => false,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePasswordIsSet
{
    public function handle(Request $request, Closure $next) {
        $user = $request->user();
        if ($user && $user->is_invited && ! $user->password_set_at) {
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Please set your password first.']);
        }
        return $next($request);
    }
}
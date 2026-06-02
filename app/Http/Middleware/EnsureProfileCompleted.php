<?php

namespace App\Http\Middleware;

use App\Services\User\ProfileCompletionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileCompleted
{
    public function handle(Request $request, Closure $next): Response {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        $service = app(ProfileCompletionService::class);

        if (
            $user->hasRole('owner')
            && ! $service->isOwnerProfileComplete($user)
        ) {
            return redirect()
                ->route('profile.complete');
        }

        if (
            $user->hasRole('seeker')
            && ! $service->isSeekerProfileComplete($user)
        ) {
            return redirect()
                ->route('profile.complete');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
    	 if (!Auth::check()) {
            return redirect()->route('login');
        }

    	  if (empty($roles)) {
            abort(403, 'No role defined for this route.');
        }

        // Multiple roles allow (like "1|2")
        $allowed = collect(explode('|', $roles))
            ->map(fn($r) => (int) trim($r))
            ->filter()
            ->values();

        $userRole = (int) (Auth::user()->role ?? 0);

        if (!$allowed->contains($userRole)) {
            abort(403, 'Unauthorized.');
        }
        return $next($request);
    }
}


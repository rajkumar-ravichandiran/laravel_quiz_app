<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        // Exclude the admin user from email verification
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }
        if (!$request->user() || ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Your email address must be verified.'], 403)
                : redirect()->route($redirectToRoute ?: 'verification.notice');
        }

        return $next($request);
    }
}

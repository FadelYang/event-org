<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyThatUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userIdFromRoute = $request->route('userId');

        $authenticatedUserId = Auth::id();

        if ($userIdFromRoute && $authenticatedUserId == $userIdFromRoute) {
            return $next($request);
        }

        return redirect('home')
            ->with('error-alert', 'Oops')
            ->with('alert-message', 'You are not allowed to access this page');
    }
}

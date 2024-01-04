<?php

namespace App\Http\Middleware;

use App\Enum\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if (Auth::user() && Auth::User()->role == UserRoleEnum::ADMIN) {
            return $next($request);
        }

        return redirect('home')->with('error-alert', 'oops')->with('alert-message', 'You are not allowed to acces this page');

    }
}

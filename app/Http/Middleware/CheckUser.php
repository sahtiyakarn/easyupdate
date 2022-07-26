<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $myUser = "";

        $is_admin = Auth::guard('admin')->user()->is_admin;
        foreach ($roles as $role) {
            if ($is_admin == $role) {
                $myUser = $role;
            }
        }
        // dd($myUser);
        if (!empty($myUser)) {
            return  $next($request);
        } else {
            abort(401);
        }
    }
}

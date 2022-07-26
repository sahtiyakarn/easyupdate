<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$is_admin)
    {
        // $roles = explode('|', $is_admin);
        $roles = Auth::guard('admin')->user()->is_admin;
        // dd($roles);
        foreach ($is_admin as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if ($roles == $role) {
                return $next($request);
            } else {
                abort(401);
            }
        }


        // foreach ($roles as $role) {
        // if (Auth::guard('admin')->user()->is_admin == $role) {
        //     return $next($request);
        // } else {
        //     abort(401);
        // }
        // }
        // if (Auth::guard('admin')->user()->is_admin == $roles) {
        //     return $next($request);
        // } else {
        //     abort(401);
        // }
    }
}

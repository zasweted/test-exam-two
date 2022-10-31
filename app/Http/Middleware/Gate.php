<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Gate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $permissions = [
            0 => ['user'],
            10 => ['user', 'admin']
        ];

        if(!in_array($role, $permissions[Auth::user()->role])){
            abort(401);
        }

        // dd(Auth::user()->role);
        // dd($role);
        return $next($request);
    }
}

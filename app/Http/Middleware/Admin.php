<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        dd('labas');
        // $permissions = [
        //     0 => ['user', 'home'],
        //     1 => ['user', 'admin', 'home']
        // ];

        // if(!Auth::user()){
        //     return redirect('login');
        // }

        // if(!in_array($role, $permissions[Auth::user()->role])){
        //     abort(401);
        // }
        
        return $next($request);
    }
}

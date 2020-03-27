<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AksesAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role1 = null)
    {
        if (Auth::user()->akses == 'pelanggan' && $role1 == 'pelanggan'){
            return $next($request);
         } elseif (Auth::user()->akses == 'owner' && $role1 == 'owner') {
             return $next($request);
         } elseif (Auth::user()->akses == 'waiter' && $role1 == 'waiter') {
             return $next($request);
         } elseif (Auth::user()->akses == 'kasir' && $role1 == 'kasir') {
             return $next($request);
         } elseif (Auth::user()->akses == 'admin') {
             return $next($request);
         }

         return abort(404);
    }
}

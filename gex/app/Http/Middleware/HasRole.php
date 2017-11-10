<?php

namespace App\Http\Middleware;

use Closure;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->can($role.'-access') || $request->user()->can('admin-access') || $request->user()->can('admin2-access')) {
            return $next($request);
        }

        return redirect('home')->with('anda tidak punya akses untuk halaman tersebut.');
    }
}

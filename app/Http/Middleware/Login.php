<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->get('etablissement')){
            return new RedirectResponse(url('dashboard/'));
        }else{
            return new RedirectResponse(url('dash/auth'));
        }

        return $next($request);

    }
}

<?php

namespace App\Http\Middleware;

use Closure;

//Auth Facade
use Illuminate\Support\Facades\Auth;

class AuthenticateEtablissement
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
        //If request does not comes from logged in seller
        //then he shall be redirected to Seller Login page
        if (! Auth::guard('etablissements')->check()) {
            return redirect(route('dash_login_form'));
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
class RedirectIfEtablissementAuthenticated
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
        //If request comes from logged in user, he will
        //be redirect to home page.
        if (Auth::guard()->check()) {
            return redirect('/home');
        }

        //If request comes from logged in Etablissement, he will
        //be redirected to Etablissement's home page.
        if (Auth::guard('etablissements')->check()) {
            return redirect(route('dash_home'));
        }
        return $next($request);
    }
}

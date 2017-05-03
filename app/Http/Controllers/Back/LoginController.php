<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'back/index/';

    /**
     * Show login Form.
     *
     * @return Redirect
     */
    public function showLoginForm()
    {
        return view('Back.auth.login');
    }

    /**
     * Validate an authentication attempt.
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required'
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        if (Auth::guard('etablissements')->attempt(['email' => Input::get('email'), 'password' => Input::get('password'),'actif' => 1])) {
            // Authentication passed...
            return redirect()->intended($this->redirectTo);
        }else{
            return redirect(route('dash_login_form'))->withInput()->with('actif','Votre Compte est pour l\'instant inactif.Veuillez nous contacter pour l\'activation');
        }
    }

    /**
     * Custom guard for etablissement
     * @return Guard
     * */
    protected function guard()
    {
      return Auth::guard('etablissements');
    }
}

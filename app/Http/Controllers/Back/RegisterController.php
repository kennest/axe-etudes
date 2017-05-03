<?php

namespace App\Http\Controllers\Back;

use App\Model\Adresse;
use App\Model\Etablissement;
use App\Http\Controllers\Controller;
use App\Model\Galerie;
use App\Model\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    protected $redirectPath = '/login';

    //shows registration form to seller
      public function showRegistrationForm()
      {
          $types=Type::all();
        $etablissement=new Etablissement();
          return view('Back.auth.register',compact('etablissement','types'));
      }

      public function register(Request $request)
         {

            //Validates data
             $this->validator($request->all())->validate();

            //Create seller
             $etablissement = $this->create($request->all());

             //Authenticates seller
             $this->guard()->login($etablissement);

            //Redirects sellers
             return redirect($this->redirectPath);
         }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'titre' => 'required|max:255',
            'email' => 'required|email|max:255|unique:etablissements',
            'sigle' => 'required|min:2',
            'logo' => 'required|max:250',
            'telephone' => 'required',
            'password' => 'required|confirmed',
            'types'=>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      //store etablissement
        $etablissement=new Etablissement();
        $adresse=new Adresse();

        $etablissement->titre=$data['titre'];
        $etablissement->sigle=$data['sigle'];
        $etablissement->email=$data['email'];
        $etablissement->telephone=$data['telephone'];

        $adresse->ville=$data['ville'];

        //hidden inputs
        $etablissement->password=bcrypt($data['password']);
        $etablissement->slug=$data['slug'];
        $etablissement->statut=$data['statut'];
        $etablissement->code=$data['password'];
        //store logo dans le repertoire 'logos'
        $fileName=$data['logo']->store('logos/', 'public');
        $etablissement->logo=$fileName;
        $etablissement->type()->associate($data['types']);



        //On creer les dossiers de galerie de l'etablissement
        if($etablissement->save()){
//            Storage::makeDirectory('Galerie/'.$etablissement->sigle.'/photos','public');
//            Storage::makeDirectory('Galerie/'.$etablissement->sigle.'/videos','public');

            //On cree par la meme occasion la galerie
            $galerie=new Galerie();
            $galerie->titre=$etablissement->sigle;
            $galerie->etablissement()->associate($etablissement);
            $galerie->save();

            $adresse->etablissement()->associate($etablissement);
            $adresse->save();
        }

        Session::flash("success","L\"'Etablissement a été enregistrer!un email contenant les informations de connexion vous a été envoyé." );
        return $etablissement;
    }

    //Get the guard to authenticate etablissement
  protected function guard()
  {
      return Auth::guard('etablissements');
  }

}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 21/04/17
 * Time: 13:58
 */

namespace App\Http\Controllers\Back\Actions;


use App\Http\Controllers\Controller;
use App\Model\Adresse;
use App\Model\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    public function show()
    {
        $etablissement = Auth('etablissements')->user();
        $gmap=true;
        return view('Back.pages.ShowProfil', compact('etablissement','gmap'));
    }

    public function CreateInfoSup()
    {
        $web = new Web();
        $gmap=true;
        return view('Back.pages.AddInfoSup',compact('web','gmap'));
    }

    public function StoreInfoSup(Request $request)
    {
        $this->validate($request,Web::$rules);
        $this->validate($request,Adresse::$rules);

        $web=new Web();
        $web->facebook=Input::get('facebook');
        $web->twitter=Input::get('twitter');
        $web->youtube=Input::get('youtube');
        $web->siteweb=Input::get('siteweb');
        $web->lat=Input::get('lat');
        $web->long=Input::get('long');

        $etablissement=Auth('etablissements')->user();

        $adresse=$etablissement->adresse()->first();
        $adresse->rue=Input::get('rue');
        $adresse->bp=Input::get('bp');
        $adresse->quartier=Input::get('quartier');

        $adresse->update();

        $web->etablissement()->associate($etablissement);

        $web->save();
        return redirect(route('profil.show'));
    }

    public function UpdateinfoSup()
    {

    }
}
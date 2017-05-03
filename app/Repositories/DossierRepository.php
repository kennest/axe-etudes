<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 31/03/17
 * Time: 12:25
 */

namespace App\Repositories;


use App\Model\Dossier;
use Illuminate\Http\Request;

class DossierRepository
{
    public function  store(Request $request){
        $dossier=new Dossier();
        $dossier->etablissement()->associate(Auth('etablissements')->user());
        $dossier->libelle=$request->input('libelle');
        $dossier->frais=$request->input('frais');
        $dossier->types=$request->input('types');
        $dossier->save();
    }
    public function  update(Request $request,$dossier){
        $dossier->libelle=$request->input('libelle');
        $dossier->frais=$request->input('frais');
        $dossier->types=$request->input('types');
        $dossier->update();
    }
}
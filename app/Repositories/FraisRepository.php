<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 26/03/17
 * Time: 19:53
 */

namespace App\Repositories;


use App\Model\Frais;
use App\Model\Niveau;
use App\Model\Versement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FraisRepository
{
    public function store(Request $request)
    {
        $niveau = $request->input('niveaux');
        $frais = new Frais();
        $frais->frais=$request->input('frais');
        $frais->scolarite=$request->input('scolarite');
        $frais->niveau()->associate($niveau);
        $frais->etablissement()->associate(Auth::guard('etablissements')->user());
        $frais->save();
    }

    public function storeVersement(Request $request){
        $versement=new Versement();
        $versement->valeur=$request->input('valeur');
        $versement->frais_id=$request->input('frais_id');
        if($this->checkVersementForStore($request->input('frais_id'),$request)){
            $versement->save();
        }else{
            return redirect()->back()->withErrors('La somme des versements ne peut pas être supérieure a la scolarité');
        }
    }

    public  function updateVersement(Request $request){
        $versement=Versement::FindOrFail($request->input('versement_id'));
        $versement->valeur=$request->input('valeur');
        if($this->checkVersementForUpdate($request->input('frais_id'),$request)){
            $versement->update();
        }else{
            return redirect()->back()->withErrors('La somme des versements ne peut pas être supérieure a la scolarité');
        }
    }


/** VERIFIE SI LA SOMME DES VERSEMENTS DU FRAIS ET DE LA VALEUR DU VERSEMENT EN COUS
    D'INSERTION NE DEPASSE PAS LA SCOLARITE*/
    private function checkVersementForStore($frais_id,$request){
        $frais=Frais::FindOrFail($frais_id);

        $scolarite=$frais->scolarite;

        $valeur=$request->input('valeur');
        $versements=$frais->versements()->get();
        $total=$versements->sum('valeur');
        if(($valeur+$total)>$scolarite){
            return false;
        }else{
            return true;
        }
    }

    /** VERIFIE SI LA SOMME DES VERSEMENTS DU FRAIS ET DE LA VALEUR DU VERSEMENT EN COURS
    DE MODIFICATION NE DEPASSE PAS LA SCOLARITE*/
    private function checkVersementForUpdate($frais_id,$request){
        $frais=Frais::FindOrFail($frais_id);

        $scolarite=$frais->scolarite;

        $current_versement=Versement::FindOrFail($request->input('versement_id'));

        $valeur=$request->input('valeur');
        $versements=$frais->versements()->get();
        $versements=$versements->where('id','!=',$current_versement->id);
        $total=$versements->sum('valeur');
        if(($valeur+$total)>$scolarite){
            return false;
        }else{
            return true;
        }
    }

    public function update(Request $request,$id){
        $niveau = $request->input('niveaux');
        $frais = Frais::FindOrFail($id);
        $frais->frais=$request->input('frais');
        $frais->scolarite=$request->input('scolarite');
        $frais->niveau()->associate($niveau);
        $frais->etablissement()->associate(Auth::guard('etablissements')->user());
        $frais->update();
    }

    public function destroy($id){
        $frais=Frais::FindOrFail($id);
        $frais->niveau()->dissociate($this->getFraisOfUserIsFilled());
        $frais->etablissement()->dissociate(Auth::guard('etablissements')->user());
        $frais->delete();
    }

    //RECUPERATION DES FRAIS QUI ON DEJA ETE RENSEIGNER PAR L'UTILISATEUR COURANT
    public function getFraisOfUserIsFilled(){
        $frais = frais::whereHas('niveau', function ($query) {
            $query->where('etablissement_id', '=', Auth::guard('etablissements')->user()->id);
        })->with('niveau')->get();
        return $frais;
    }

    //RECUPERATION DES NIVEAUX QUI N'ONT PAS ENCORE ETE RENSEIGNER PAR L'UTILISATEUR COURANT
    public function getNiveauWithEmptyFrais(){
        $niveaux = Niveau::whereDoesntHave('frais', function ($query) {
            $query->where('etablissement_id', '=', Auth::guard('etablissements')->user()->id);
        })->get();
        return $niveaux;
    }

    //RECUPERATION DU NIVEAU LIÉ AU FRAIS A EDITER
    public function getNiveauLinkedToFraisEdited($frais){
        //recuperation du niveau lié au frais a editer
        $niveau=Niveau::whereHas('frais', function ($query) use($frais) {
            $query->where('niveau_id', '=',$frais->niveau_id);
        })->get();
        return $niveau;
    }

    //RECUPERATION DE LA LISTE DES NIVEAUX DE L'UTILISATEUR COURANT EN OMETTANT CELUI DONT LE FRAIS ES A EDITÉ
    public function getNiveauOfUserWithoutEdited($frais){

        $list_niveaux = Niveau::whereHas('frais', function ($query) {
            $query->where('etablissement_id', '=', Auth::guard('etablissements')->user()->id);
        })->get();
        $others=$this->getNiveauOfUserSystem()->reject(function ($niveau) use ($frais) {
            return $niveau->id === $frais->niveau_id;
        });
        return $others;
    }

    //RETOURNE LES NIVEAUX EN FONCTION DES SYSTEMES CHOISIS PAR L'ETABLISSEMENTS ET RETOURNE CEUX QUI N'ONT PAS ENCORE DE FRAIS
    public function getNiveauOfUserSystem(){

        //LISTE DES SYSTEMES DE L'ETABLISSEMENT
        $systemes=Auth::guard('etablissements')->user()->systemes()->get();

        //LISTE DES NIVEAUX DES DIFFERENTS SYSTEMES AVEC LEUR FRAIS LIES
        $LIST_NIVEAUX=$systemes->map(function($systeme)
        {
             return $systeme->niveaux()->with('frais')->get();
        });

        //ON COMBINE LA LISTE DES NIVEAUX EN UNE SEULE LISTE
        $LIST_NIVEAUX=$LIST_NIVEAUX->collapse();

        //LISTE DES NIVEAUX DONT LES FRAIS ON DEJA ETE SAISI
        $OTHER_NIVEAUX = Niveau::whereHas('frais', function ($query) {
            $query->where('etablissement_id', '=', Auth::guard('etablissements')->user()->id);
        })->get();

        //ON EXTRAIT SEULEMENT CEUX DONT LES FRAIS N'ONT PAS ENCORE ETE SAISI PAR CET ETABLISSEMENT
        $filtered=$LIST_NIVEAUX->diffKeys($OTHER_NIVEAUX);

        return $filtered;
    }

}
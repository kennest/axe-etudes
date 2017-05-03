<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 21/04/17
 * Time: 11:13
 */

namespace App\Repositories;


use App\Model\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiliereRepository
{
    public function store(Request $request){
        $etablissement=Auth::guard('etablissements')->user();
        $etablissement->filieres()->sync($request->get('filieres'));
        $etablissement->update();
    }

    public function destroy($id){
        $filiere=Filiere::findOrFail($id);
        $etablissement=Auth::guard('etablissements')->user();
        $etablissement->filieres()->detach($filiere);
        $etablissement->update();
    }
}
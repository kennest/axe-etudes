<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    protected $fillable=['libelle','types','frais','etablissement_id'];

    public static $rules=[
        'libelle'=>'required|min:3',
        'types'=>'required|in:new,old,candidat'
    ];

    //ACCESSOR
    public function getTypesAttribute($value){
        if($value=='new'){
            return 'Nouvelle Inscription';
        }elseif ($value=='old'){
            return 'Réinscription';
        }else{
            return 'Dossier de Candidature';
        }
    }

    //RELATIONS
    public function etablissement(){
        return $this->belongsTo(\App\Model\Etablissement::class);
    }

}

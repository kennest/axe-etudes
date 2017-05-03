<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{

    protected $fillable=['titre','etablissement_id'];


    public static $rules=[
        'titre'=>'unique:filieres|min:2|required'
    ];

    public function etablissements()
    {
        return $this->belongsToMany('App\Model\Etablissement');
    }

    public function niveaux()
    {
        return $this->belongsToMany('App\Model\Niveau');
    }
}

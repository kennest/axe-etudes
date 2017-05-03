<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    protected $fillable=['titre','etablissement_id'];

    public static $rules=[
        'titre'=>'required|min:3'
    ];
    //RELATIONS
    public function etablissement()
    {
        return $this->belongsTo('App\Model\Etablissement');
    }

    public function photos(){
        return $this->hasMany(\App\Model\Photo::class);
    }

    public function videos(){
        return $this->hasMany(\App\Model\Video::class);
    }
}

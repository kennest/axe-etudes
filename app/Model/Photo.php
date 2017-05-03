<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Photo extends Model
{
    protected $fillable=['path','thumbnail','galerie_id'];

    public static $rules=[
        'path'=>'required'
    ];
    //RELATIONS
    public function galerie(){
        return $this->belongsTo(\App\Model\Galerie::class);
    }


    //GETTERS
    public function getPathAttribute($value){
        return 'public/Galerie/'.Auth::guard('etablissements')->user()->sigle.'/photos/'.$value;
    }

    public function getThumbnailAttribute($value){
        return 'public/Galerie/'.Auth::guard('etablissements')->user()->sigle.'/photos/thumbs/'.$value;
    }
}

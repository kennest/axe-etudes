<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $table='niveaux';

    protected $fillable=['titre','systeme_id'];

    public static $rules=[
      'titre'=>'unique:niveaux|min:2|required'
    ];

    public function frais(){
        return $this->hasOne(\App\Model\Frais::class);
    }

    public function versements(){
        return $this->hasMany(\App\Model\Versement::class);
    }

    public function systeme(){
        return $this->belongsTo(\App\Model\Systeme::class);
}
}

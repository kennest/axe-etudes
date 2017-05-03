<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable=['titre','etablissement_id'];

    public function etablissements(){
        return $this->hasMany('App\Model\Etablissement');
    }
}

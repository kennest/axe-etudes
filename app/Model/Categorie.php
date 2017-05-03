<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable=['titre','slug'];

    public function articles(){
        return $this->hasMany('App\Model\Article');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable=['titre','path','galerie_id'];
    //RELATIONS
    public function galerie(){
        return $this->belongsTo(\App\Model\Galerie::class);
    }
}

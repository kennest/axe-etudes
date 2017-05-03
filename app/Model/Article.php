<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=['titre','slug','contenu','categorie_id'];

    public function categorie(){
        return $this->belongsTo('App\Model\Categorie');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table='conditions';

    protected $fillable=['libelle','description','rentree','niveau_id'];

    public function niveau(){
        return $this->hasOne('App\Model\Niveau');
    }
}

<?php

namespace App\Model;

use app\Http\Controllers\Guest\LinkedToEtablissement;
use Illuminate\Database\Eloquent\Model;

class Distinction extends Model implements LinkedToEtablissement
{
    protected $fillable=['titre','photo','description'];

    public function etablissement()
    {
        return $this->belongsTo('App\Model\Etablissement');
    }
}

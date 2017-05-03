<?php

namespace App\Model;

use app\Http\Controllers\Guest\LinkedToEtablissement;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{

    protected $fillable=['ville','rue','bp','quartier'];

    protected $table='adresses';

    public  static $rules=[
        'ville'=>'alpha',
        'rue'=>'alpha_num',
        'bp'=>'string',
        'quartier'=>'alpha_num'
    ];

    public function etablissement()
    {
        return $this->belongsTo('App\Model\Etablissement');
    }
}

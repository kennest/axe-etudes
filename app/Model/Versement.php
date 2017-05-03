<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    protected $table='versements';

    public static $rules=[
        'valeur'=>'numeric|min:4|required'
    ];
    protected $fillable=['valeur','frais_id'];

    public function frais(){
        return $this->belongsTo(\App\Model\Frais::class);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 26/03/17
 * Time: 20:13
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    protected $fillable = ['frais','scolarite','niveau_id'];

    protected $table='frais';

    public static $rules=[
        'scolarite'=>'numeric|min:4|required',
        'frais'=>'numeric|min:4|required'
    ];


    public function niveau(){
        return $this->belongsTo(\App\Model\Niveau::class);
    }

    public function versements(){
        return $this->hasMany(\App\Model\Versement::class);
    }

    public function etablissement(){
        return $this->belongsTo(\App\Model\Etablissement::class);
    }


}
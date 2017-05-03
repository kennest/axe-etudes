<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 11/04/17
 * Time: 09:36
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Systeme extends Model
{
    protected $fillable = ['titre'];

    public static $rules = [
        'titre' => 'required|min:2|unique:systemes'
    ];

//RELATIONS

    public function etablissements()
    {
        return $this->hasMany(\App\Model\Etablissement::class);
    }

    public function niveaux(){
        return $this->hasMany(\App\Model\Niveau::class);
    }
}
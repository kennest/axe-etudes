<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Etablissement extends Authenticatable
{
   use Notifiable;

    protected $fillable = ['titre','sigle','email','logo','slug','actif','password','code','telephone','statut','type_id'];

    //GETTERS SETTERS

        public function setSlugAttribute($value){
            if(empty($value)){
                $this->attributes['slug']=Str::slug($this->titre);
            }
        }

    //Relations

    public function adresse()
    {
        return $this->hasOne('App\Model\Adresse');
    }

    public function distinctions()
    {
        return $this->hasMany('App\Model\Distinctions');
    }

    public function galeries()
    {
        return $this->hasOne('App\Model\Galerie');
    }

    public function web()
    {
        return $this->hasOne('App\Model\Web');
    }

    public function geolocalisation()
    {
        return $this->hasOne('App\Model\Geolocalisation');
    }

    public function vue()
    {
        return $this->hasOne('App\Model\Vue');
    }

    public function type()
    {
        return $this->belongsTo('App\Model\Type');
    }


    public function filieres(){
        return $this->belongsToMany(\App\Model\Filiere::class);
    }

    public function frais(){
        return $this->hasMany(\App\Model\Frais::class);
    }

    public function dossiers(){
        return $this->hasMany(\App\Model\Dossier::class);
    }

    public function systemes(){
        return $this->belongsToMany(\App\Model\Systeme::class);
    }
    //Relations

    //hidden attributes
   protected $hidden = [
       'password', 'remember_token',
   ];
}

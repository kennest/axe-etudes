<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    protected $fillable = ['lat', 'long', 'twitter', 'facebook', 'youtube', 'siteweb', 'etablissement_id'];
    protected $table = 'web';
    public static $rules = [
        'lat' => 'required|numeric',
        'long' => 'required|numeric',
        'twitter' => 'required|url',
        'facebook' => 'required|url',
        'youtube' => 'required|url',
        'siteweb' => 'required|url',
    ];

    //RELATIONS
    public function etablissement()
    {
        return $this->belongsTo(\App\Model\Etablissement::class);
    }
    //GETTERS SETTERS
}

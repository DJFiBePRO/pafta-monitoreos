<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    public $timestamps = true;

    //Relacion uno a muchos (inversa)
    public function monitoreo(){
        return $this->belongsTo('App\Models\Monitoreo')->withtimestamps();
    }
}

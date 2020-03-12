<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps = false;    
    protected $fillable   = ['dupla1_id', 'dupla2_id', 'tipo', 'grupo_id'];
    protected $guarded    = ['id'];    


    Public function resultados(){

        return $this->hasMany(\App\PartidaResultado::class);

    }


}

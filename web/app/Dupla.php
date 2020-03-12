<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dupla extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps = false;    
    protected $fillable   = ['jogador1_id', 'jogador2_id', 'etapa_id'];
    protected $guarded    = ['id'];

   
}

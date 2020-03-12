<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartidaResultado extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps = false;    
    protected $table = 'partidas_resultados';
    protected $fillable   = ['partida_id', 'dupla_id', 'pontos', 'vitoria', 'derrota'];
    protected $guarded    = ['id'];    
}

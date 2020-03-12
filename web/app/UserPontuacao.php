<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPontuacao extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps = false;    
    protected $fillable   = ['jogador_id', 'pontos', 'etapa_id'];
    protected $guarded    = ['id'];
}

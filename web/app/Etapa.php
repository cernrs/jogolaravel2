<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps = false;    
    protected $fillable   = ['data', 'inscricoes_abertas', 'etapa'];
    protected $guarded    = ['id'];
    
}

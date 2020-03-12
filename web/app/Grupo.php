<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps = false;    
    protected $fillable   = ['chave', 'posicao', 'dupla_id', 'etapa_id'];
    protected $guarded    = ['id'];    
}

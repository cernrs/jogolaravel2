<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public    $timestamps = true;    
    protected $fillable   = ['name', 'label'];
    protected $guarded    = ['id'];

    Public function permissions(){

        return $this->belongsToMany(\App\Permission::class);

    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    public    $timestamps = true;    
    protected $fillable   = ['name', 'label'];
    protected $guarded    = ['id'];

    Public function roles(){

        return $this->belongsToMany(\App\Role::class);

    }


}

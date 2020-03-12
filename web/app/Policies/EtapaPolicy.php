<?php

namespace App\Policies;

use App\User;
use App\Etapa;
use Illuminate\Auth\Access\HandlesAuthorization;

class EtapaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function updateEtapa(User $user, Etapa $etapa){

        return $user->id == $etapa->id;
    }

}

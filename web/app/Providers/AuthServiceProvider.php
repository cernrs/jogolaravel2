<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // When using the command line, do not execute this block
        if ( !app()->runningInConsole() ){ 
                
            $permissions = Permission::with('roles')->get();

            foreach ($permissions as $permission) {
                $gate->define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }

            // Acesso livre para o perfil Root
            $gate->before(function (User $user, $ability) {

                if ($user->hasAnyRoles('Root')) {
                    return true;
                }
            });
        }

    }
}

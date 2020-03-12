<?php

use Illuminate\Database\Seeder;
use App\PermissionRole;

class PermissionsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Root todas
        PermissionRole::create(['permission_id' => '1', 'role_id' => '1']);
        PermissionRole::create(['permission_id' => '2', 'role_id' => '1']);
        PermissionRole::create(['permission_id' => '3', 'role_id' => '1']);
       
        // Admin ver e editar
        PermissionRole::create(['permission_id' => '1', 'role_id' => '2']);
        PermissionRole::create(['permission_id' => '2', 'role_id' => '2']);
       
        // Jogador ver 
        PermissionRole::create(['permission_id' => '1', 'role_id' => '3']);
    }
}

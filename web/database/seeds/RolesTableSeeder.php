<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        Role::create(['name' => 'Root', 'label' => 'Super usuário do sistema']);
        Role::create(['name' => 'Admin', 'label' => 'Administrador do sistema']);
        Role::create(['name' => 'Jogador', 'label' => 'Usuário comum do sistema']);
       
    }
}

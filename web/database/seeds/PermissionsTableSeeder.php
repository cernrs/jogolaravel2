<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        Permission::create(['name' => 'view_etapa', 'label' => 'Vizualisa a etapa']);
        Permission::create(['name' => 'edit_etapa', 'label' => 'Edita a etapa']);
        Permission::create(['name' => 'delete_etapa', 'label' => 'Deleta a etapa']);
       
    }
}

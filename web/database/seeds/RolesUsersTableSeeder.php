<?php

use Illuminate\Database\Seeder;
use App\RoleUser;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Root to user default id 1 
        RoleUser::create(['user_id' => '17', 'role_id' => '1']);
    }
}

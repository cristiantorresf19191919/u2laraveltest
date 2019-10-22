<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->is_admin = true;
        $role->timestamps = false;
        $role->save();

        $role = new Role();
        $role->name = 'usuario';
        $role->description = 'Usuario';
        $role->is_admin = false;
        $role->timestamps = false;
        $role->save();
    }
}

<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_usuario = Role::where('name', 'usuario')->first();
        $rol_administrador = Role::where('name', 'admin')->first();
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@ejemplo.com';
        $user->city = 'bogota';
        $user->username = 'usuarios12342';
        $user->password = bcrypt('secreto');
        $user->save();
        $user->roles()->attach($rol_usuario);
        $user = new User();
        $user->name = 'Admin';
        $user->city = 'ny';
        $user->username = 'adminusuario';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($rol_administrador);
    }
}

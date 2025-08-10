<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'ADMINISTRADOR',
            'last_name' => 'ADMINISTRADOR',            
            'email' => 'administrador@gmail.com',
            'name' => 'administrador',
            'password' => bcrypt('administrador'),
        ]);

        DB::table('permissions')->insert([
            'name' => 'ADMINISTRADOR',
            'display_name' => 'ADMINISTRADOR',
            'description' => 'ADMINISTRADOR'
        ]);
        DB::table('permissions')->insert([
            'name' => 'AFILIACION',
            'display_name' => 'AFILIACION',
            'description' => 'AFILIACION'
        ]);
        DB::table('permissions')->insert([
            'name' => 'ACTIVIDAD',
            'display_name' => 'ACTIVIDAD',
            'description' => 'ACTIVIDAD'
        ]);
        DB::table('permissions')->insert([
            'name' => 'APORTE',
            'display_name' => 'APORTE',
            'description' => 'APORTE'
        ]);
        DB::table('permissions')->insert([
            'name' => 'REPORTE',
            'display_name' => 'REPORTE',
            'description' => 'REPORTE'
        ]);

        DB::table('roles')->insert([
            'name' => 'ADMINISTRADOR',
            'display_name' => 'ADMINISTRADOR',
            'description' => 'ADMINISTRADOR'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '1',
            'role_id' => '1'
        ]);

        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1'
        ]);

    }
}

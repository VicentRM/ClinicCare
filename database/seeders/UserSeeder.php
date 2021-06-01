<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nombre_rol' => 'administrador',            
        ]);
        DB::table('users')->insert([
            'name' => 'MedicoDemo',
            'email' => 'medico@demo.es',
            'role_id' => 1,
            'password' => Hash::make('medico1234'),
        ]);
        DB::table('medicos')->insert([
            'NIF' =>12345678A
            'nombre' => 'Medico',
            'apellidos' => 'Demo Probando',            
            'num_colegiado' => '12345',
            'user_id' => 1,            
        ]);

      
    }
}

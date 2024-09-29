<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles_type')->insert(['id' => 1, 'name' => 'Líder','description' => 'Persona que tiene a su cargo una célula','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 2, 'name' => 'Supervisor','description' => 'Persona que tiene a su cargo varias células','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 3, 'name' => 'Pastor de Zona','description' => 'Persona que tiene a su cargo varios sectores','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 4, 'name' => 'Pastor de Distrito','description' => 'Persona que tiene a su cargo varias Zonas','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 5, 'name' => 'Pastor General','description' => 'Pastor general de la iglesia Elim','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 6, 'name' => 'Comité de Apoyo','description' => 'Encargados de Registrar todas las ofrendas de la iglesia','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 7, 'name' => 'Recepcionista','description' => 'Secretarias','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 8, 'name' => 'Administrador','description' => 'Encargado de la administracion del sistema informatico','status' => 1]);
        DB::table('profiles_type')->insert(['id' => 10, 'name' => 'inactivo','description' => 'Usuario inactivo','status' => 0]);
    }
}

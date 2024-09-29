<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrador']);
        $elder = Role::create(['name' => 'Anciano']);
        $p_general = Role::create(['name' => 'Pastor General']);
        $p_district = Role::create(['name' => 'Pastor de Distrito']);
        $p_zone = Role::create(['name' => 'Pastor de Zona']);
        $supervisor = Role::create(['name' => 'Supervisor']);
        $leader = Role::create(['name' => 'Líder']);
        $support_committee = Role::create(['name' => 'Comité de apoyo']);
        $receptionist = Role::create(['name' => 'Recepcionista']);

        // Permission::create(['name' => 'Crear célula'])->assignRole($admin);
        // Permission::create(['name' => 'Listar células'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone, $supervisor]);
        // Permission::create(['name' => 'Ver célula'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone, $supervisor, $leader]);
        // Permission::create(['name' => 'Editar célula'])->assignRole($admin);
        // Permission::create(['name' => 'Borrar célula'])->assignRole($admin);
        // Permission::create(['name' => 'Crear reporte'])->syncRoles([$admin, $supervisor, $leader]);
        // Permission::create(['name' => 'Listar reportes'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone, $supervisor, $leader]);
        // Permission::create(['name' => 'Ver reporte'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone, $supervisor, $leader]);
        // Permission::create(['name' => 'Editar reporte'])->syncRoles([$admin, $supervisor, $leader]);
        // Permission::create(['name' => 'Borrar reporte'])->syncRoles([$admin, $supervisor, $leader]);
        // Permission::create(['name' => 'Crear sector'])->assignRole($admin);
        // Permission::create(['name' => 'Listar sectores'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone]);
        // Permission::create(['name' => 'Ver sector'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone, $supervisor]);
        // Permission::create(['name' => 'Editar sector'])->assignRole($admin);
        // Permission::create(['name' => 'Borrar sector'])->assignRole($admin);
        // Permission::create(['name' => 'Crear zona'])->assignRole($admin);
        // Permission::create(['name' => 'Listar zonas'])->syncRoles([$admin, $elder, $p_general, $p_district]);
        // Permission::create(['name' => 'Ver zona'])->syncRoles([$admin, $elder, $p_general, $p_district, $p_zone]);
        // Permission::create(['name' => 'Editar zona'])->assignRole($admin);
        // Permission::create(['name' => 'Borrar zona'])->assignRole($admin);
        // Permission::create(['name' => 'Crear distrito'])->assignRole($admin);
        // Permission::create(['name' => 'Listar distritos'])->syncRoles([$admin, $elder, $p_general]);
        // Permission::create(['name' => 'Ver distrito'])->syncRoles([$admin, $elder, $p_general, $p_district]);
        // Permission::create(['name' => 'Editar distrito'])->assignRole($admin);
        // Permission::create(['name' => 'Borrar distrito'])->assignRole($admin);
    }
}

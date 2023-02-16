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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Recluter']);
        $role3 = Role::create(['name' => 'Candidate']);

        Permission::create(['name' => 'admin.usuarios.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.destroy'])->assignRole($role1);

        Permission::create(['name' => 'admin.empresas.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.empresas.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.empresas.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.empresas.destroy'])->assignRole($role1);

        Permission::create(['name' => 'admin.entrevistas.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.entrevistas.create'])->assignRole($role2);
        Permission::create(['name' => 'admin.entrevistas.edit'])->assignRole($role2);
        Permission::create(['name' => 'admin.entrevistas.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.cuestionarios.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.cuestionarios.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.cuestionarios.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.cuestionarios.destroy'])->syncRoles([$role1, $role2]);
         
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $role1 = Role::create(['name'=> "VIGILANCIA"]);

        Permission::create(['name'=> 'PaseSalida'])->syncRoles([$role1]);
        Permission::create(['name'=> 'Panel'])->syncRoles([$role1]);
        Permission::create(['name'=> 'INFORME-SM']) ;


    }
}

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
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'administrator']);
        $admin->givePermissionTo(Permission::all());
        
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'operator']);
        Role::create(['name' => 'produksi_cuci']);
        Role::create(['name' => 'produksi_setrika']);
        Role::create(['name' => 'delivery']);
        Role::create(['name' => 'customer']);
    }
}

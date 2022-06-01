<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $permission = Permission::create(['name' => '/users'])->assignRole($admin);
        $permission = Permission::create(['name' => '/users/create'])->assignRole($admin);
        $permission = Permission::create(['name' => '/users/store'])->syncRoles([$admin, $user]);
        $permission = Permission::create(['name' => '/users/edit'])->syncRoles([$admin, $user]);
        $permission = Permission::create(['name' => '/users/update'])->syncRoles([$admin, $user]);
        $permission = Permission::create(['name' => '/users/updateState'])->assignRole($admin);
    }
}

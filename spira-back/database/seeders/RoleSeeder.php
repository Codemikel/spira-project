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
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $studentRole = Role::create(['name' => 'student']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'assign courses']);
        Permission::create(['name' => 'view users with courses']);
        Permission::create(['name' => 'view assigned courses']);

        $adminRole->givePermissionTo(['create users', 'assign courses', 'view users with courses']);
        $studentRole->givePermissionTo('view assigned courses');
    }
}

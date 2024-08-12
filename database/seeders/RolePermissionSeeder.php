<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);

        $permissions = [
            ['name' => 'user list'],
            ['name' => 'create usre'],
            ['name' => 'edit usre'],
            ['name' => 'delete usre'],
            ['name' => 'role list'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
        ];

        foreach($permissions as $item){
            Permission::create($item);
        }

        $role->syncPermissions(Permission::all());

        $user = User::first();
        $user->assignRole($role);
    }
}

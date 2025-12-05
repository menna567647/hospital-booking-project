<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $permissions = [
            // users
            'users' => [
                'create users',
                'read users',
                'update users',
                'delete users',
                'active users',
                'deactive users',
            ],

            // doctors
            'doctors' => [
                'create doctors',
                'read doctors',
                'update doctors',
                'delete doctors',
            ],

            // departments
            'departments' => [
                'create departments',
                'read departments',
                'update departments',
                'delete departments',
            ],

            // clients
            'clients' => [
                'create clients',
                'read clients',
                'update clients',
                'delete clients',
            ],


            // messages
            'messages' => [
                'create messages',
                'read messages',
                'update messages',
                'delete messages',
            ],

            // doctors schedules
            'doctors schedules' => [
                'create doctors schedules',
                'read doctors schedules',
                'update doctors schedules',
                'delete doctors schedules',
            ],

            // roles
            'roles' => [
                'create roles',
                'read roles',
                'update roles',
                'delete roles',
            ]
        ];

        foreach ($permissions as $group => $permissionList) {
            foreach ($permissionList as $permissionName) {
                $permission = Permission::updateOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                    'group' => $group,
                ]);
                $role->givePermissionTo($permission);
            }
        }
    }
}

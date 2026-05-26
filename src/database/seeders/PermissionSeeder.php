<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $resources = [
            'user',
            'profile',
            'project',
            'contact',
        ];

        $actions = ['view', 'create', 'update', 'delete', 'restore', 'force_delete'];

        // Create permissions
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$action}_{$resource}",
                    'guard_name' => 'web',
                ]);
            }

            // Create view_any permission
            Permission::firstOrCreate([
                'name' => "view_any_{$resource}",
                'guard_name' => 'web',
            ]);
        }

        // Assign all permissions to super_admin
        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole) {
            $allPermissions = Permission::all();
            $superAdminRole->syncPermissions($allPermissions);
        }
    }
}

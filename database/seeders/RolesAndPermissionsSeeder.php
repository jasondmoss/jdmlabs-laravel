<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * @return void
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (config('jdmlabs.auth.permissions') as $permission) {
            Permission::create([
                'guard_name' => 'auth',
                'name' => $permission
            ]);
        }

        foreach (config('jdmlabs.auth.roles') as $role) {
            $role = Role::create([
                'guard_name' => 'auth',
                'name' => $role
            ]);

            $role->givePermissionTo(Permission::all());
        }
    }

}

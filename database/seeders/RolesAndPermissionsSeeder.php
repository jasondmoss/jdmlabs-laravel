<?php

declare(strict_types=1);

namespace Database\Seeders;

use Aenginus\User\Domain\Models\PermissionModel;
use Aenginus\User\Domain\Models\RoleModel;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * @return void
     */
    public function run(): void
    {
        $roles = Config::get('jdmlabs.permissions.roles');
        $map = collect(config('jdmlabs.permissions.map'));

        app()[ PermissionRegistrar::class ]->forgetCachedPermissions();

        foreach ($roles as $name => $value) {
            $role = RoleModel::firstOrCreate([
                'id' => (string) Str::ulid(),
                'name' => $name,
                'display_name' => $value['display_name'],
                'description' => $value['description'],
                'guard_name' => config('auth.defaults.guard')
            ]);

            foreach ($value['allowed'] as $entity => $permission_key) {
                foreach (explode(',', $permission_key) as $p => $permission) {
                    $permission = PermissionModel::firstOrCreate([
                        'id' => (string) Str::ulid(),
                        'name' => $entity . '-' . $map[ $permission ],
                        'guard_name' => config('auth.defaults.guard')
                    ]);

                    $role->givePermissionTo($permission);
                }
            }
        }

        // Assign 'me' as the administrator.
        UserModel::whereEmail(Config::get('jdmlabs.admin_email'))
            ->first()
            ->assignRole([ 'administrator' ]);
    }

}

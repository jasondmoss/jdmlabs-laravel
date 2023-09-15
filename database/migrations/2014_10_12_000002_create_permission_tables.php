<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class CreatePermissionTables extends Migration
{

    /**
     * @return void
     */
    public function up(): void
    {
        if (empty($tableNames = config('permission.table_names')) ||
            empty($columnNames = config('permission.column_names'))
        ) {
            throw new RuntimeException(
                "Error: config/permission.php not found and defaults
                could not be merged. Please publish the package configuration
                before proceeding, or drop the tables manually."
            );
        }


        Schema::dropIfExists($tableNames['permissions']);
        Schema::create($tableNames['permissions'],
            static function (Blueprint $table)
        {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('guard_name');

            $table->timestamps();
        });


        Schema::dropIfExists($tableNames['roles']);
        Schema::create($tableNames['roles'],
            static function (Blueprint $table) use ($columnNames)
        {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('guard_name');
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();

            $table->timestamps();
        });


        Schema::dropIfExists($tableNames['model_has_permissions']);
        Schema::create($tableNames['model_has_permissions'],
            static function (Blueprint $table)
            use ($columnNames, $tableNames)
        {
            $table->string('model_type');

            $table->ulid($columnNames['model_morph_key']);
            $table->index([
                $columnNames['model_morph_key'],
                'model_type'
            ], 'model_has_permissions_model_ulid_model_type_index');

            $table->ulid(PermissionRegistrar::$pivotPermission);
            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(
                [
                    PermissionRegistrar::$pivotPermission,
                    $columnNames['model_morph_key'],
                    'model_type'
                ],
                'model_has_permissions_permission_model_type_primary'
            );
        });


        Schema::dropIfExists($tableNames['model_has_roles']);
        Schema::create($tableNames['model_has_roles'],
            static function (Blueprint $table)
            use ($tableNames, $columnNames)
        {
            $table->string('model_type');

            $table->ulid(PermissionRegistrar::$pivotRole);
            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->ulid($columnNames['model_morph_key']);
            $table->index(
                [$columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_model_ulid_model_type_index'
            );

            $table->primary(
                [
                    PermissionRegistrar::$pivotRole,
                    $columnNames['model_morph_key'],
                    'model_type'
                ],
                'model_has_roles_role_model_type_primary'
            );
        });


        Schema::dropIfExists($tableNames['role_has_permissions']);
        Schema::create($tableNames['role_has_permissions'],
            static function (Blueprint $table) use ($tableNames)
        {
            $table->ulid(PermissionRegistrar::$pivotPermission);
            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->ulid(PermissionRegistrar::$pivotRole);
            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([
                PermissionRegistrar::$pivotPermission,
                PermissionRegistrar::$pivotRole
            ], 'role_has_permissions_permission_ulid_role_id_primary');
        });

        app('cache')
            ->store(
                config('permission.cache.store') !== 'default'
                    ? config('permission.cache.store')
                    : null
            )
            ->forget(config('permission.cache.key'));
    }


    /**
     * @return void
     */
    public function down(): void
    {
        if (empty($tableNames = config('permission.table_names'))) {
            throw new RuntimeException(
                "Error: config/permission.php not found and defaults
                could not be merged. Please publish the package configuration
                before proceeding, or drop the tables manually."
            );
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }

}

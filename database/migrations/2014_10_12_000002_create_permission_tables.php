<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class CreatePermissionTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     * @throws \Exception
     */
    public function up(): void
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new RuntimeException(
                'Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.'
            );
        }

        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new RuntimeException(
                'Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.'
            );
        }


        /**
         * Table: permissions
         */
        Schema::create($tableNames['permissions'],
            static function (Blueprint $table)
        {
            // $table->bigIncrements('id');
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('guard_name');

            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });


        /**
         * Table: roles
         */
        Schema::create($tableNames['roles'],
            static function (Blueprint $table)
            use ($teams, $columnNames) {
                // $table->bigIncrements('id');
                $table->ulid('id')->primary();

                if ($teams || config('permission.testing')) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                    $table->index(
                        $columnNames['team_foreign_key'],
                        'roles_team_foreign_key_index'
                    );
                }

                $table->string('name');
                $table->string('guard_name');

                $table->timestamps();

                if ($teams || config('permission.testing')) {
                    $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
                } else {
                    $table->unique(['name', 'guard_name']);
                }
            });


        /**
         * Table: model_has_permissions
         */
        Schema::create($tableNames['model_has_permissions'],
            static function (Blueprint $table)
            use ($columnNames, $tableNames, $teams) {
                // $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
                $table->ulid(PermissionRegistrar::$pivotPermission);

                $table->string('model_type');

//                $table->unsignedBigInteger($columnNames['model_morph_key']);
                $table->ulid($columnNames['model_morph_key']);

                $table->index([
                    $columnNames['model_morph_key'],
                    'model_type'
                ], 'model_has_permissions_model_id_model_type_index');

                // $table->foreign(PermissionRegistrar::$pivotPermission)
                //     ->references('id')
                //     ->on($tableNames['permissions'])
                //     ->onDelete('cascade');
//                $table->ulid(PermissionRegistrar::$pivotPermission);
                $table->foreign(PermissionRegistrar::$pivotPermission)
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade');

                if ($teams) {
                    // $table->unsignedBigInteger($columnNames['team_foreign_key']);
                    $table->ulid($columnNames['team_foreign_key']);
                    $table->index(
                        $columnNames['team_foreign_key'],
                        'model_has_permissions_team_foreign_key_index'
                    );

                    $table->primary([
                        $columnNames['team_foreign_key'],
                        PermissionRegistrar::$pivotPermission,
                        $columnNames['model_morph_key'],
                        'model_type'
                    ], 'model_has_permissions_permission_model_type_primary');
                } else {
                    $table->primary([
                        PermissionRegistrar::$pivotPermission,
                        $columnNames['model_morph_key'],
                        'model_type'
                    ], 'model_has_permissions_permission_model_type_primary');
                }
            });


        /**
         * Table: model_has_roles
         */
        Schema::create($tableNames['model_has_roles'],
            static function (Blueprint $table)
            use ($columnNames, $tableNames, $teams) {
                // $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);
                $table->ulid(PermissionRegistrar::$pivotRole);


                $table->string('model_type');
                // $table->unsignedBigInteger($columnNames['model_morph_key']);
                $table->ulid($columnNames['model_morph_key']);
                $table->index(
                    [$columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_model_id_model_type_index'
                );

                $table->foreign(PermissionRegistrar::$pivotRole)
                    ->references('id') // role id
                    ->on($tableNames['roles'])
                    ->onDelete('cascade');

                if ($teams) {
                    // $table->unsignedBigInteger($columnNames['team_foreign_key']);
                    $table->ulid($columnNames['team_foreign_key']);
                    $table->index(
                        $columnNames['team_foreign_key'],
                        'model_has_roles_team_foreign_key_index'
                    );

                    $table->primary([
                        $columnNames['team_foreign_key'],
                        PermissionRegistrar::$pivotRole,
                        $columnNames['model_morph_key'],
                        'model_type'
                    ], 'model_has_roles_role_model_type_primary');
                } else {
                    $table->primary([
                        PermissionRegistrar::$pivotRole,
                        $columnNames['model_morph_key'],
                        'model_type'
                    ], 'model_has_roles_role_model_type_primary');
                }
            });


        /**
         * Table: role_has_permissions
         */
        Schema::create($tableNames['role_has_permissions'],
            static function (Blueprint $table)
            use ($tableNames)
        {
                // $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
                // $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);
                $table->ulid(PermissionRegistrar::$pivotPermission);
                $table->ulid(PermissionRegistrar::$pivotRole);

                $table->foreign(PermissionRegistrar::$pivotPermission)
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade');

                $table->foreign(PermissionRegistrar::$pivotRole)
                    ->references('id')
                    ->on($tableNames['roles'])
                    ->onDelete('cascade');

                $table->primary([
                    PermissionRegistrar::$pivotPermission,
                    PermissionRegistrar::$pivotRole
                ], 'role_has_permissions_permission_id_role_id_primary');
            }
        );

        app('cache')
            ->store(
                config('permission.cache.store') !== 'default'
                    ? config('permission.cache.store')
                    : null
            )
            ->forget(config('permission.cache.key'));
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new RuntimeException(
                'Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.'
            );
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }

}

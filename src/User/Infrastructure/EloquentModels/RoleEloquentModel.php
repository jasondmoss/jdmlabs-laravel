<?php

declare(strict_types=1);

namespace Aenginus\User\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\Permission\Models\Role;

class RoleEloquentModel extends Role
{
    use HasUlids;
}

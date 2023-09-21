<?php

declare(strict_types=1);

namespace Aenginus\User\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\Permission\Models\Role;

class RoleModel extends Role
{
    use HasUlids;
}

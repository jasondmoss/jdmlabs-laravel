<?php

declare(strict_types=1);

namespace App\Media\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class MediaEloquentModel extends BaseMedia
{

    use HasUlids;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $timestamps = true;

    public $incrementing = false;

}
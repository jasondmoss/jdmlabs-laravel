<?php

declare(strict_types=1);

namespace App\Media\Infrastructure;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{

    use HasUlids;

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

//    public $incrementing = false;

}

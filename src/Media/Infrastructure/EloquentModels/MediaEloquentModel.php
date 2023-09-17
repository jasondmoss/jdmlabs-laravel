<?php

declare(strict_types=1);

namespace Aenginus\Media\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

/**
 * @property \Illuminate\Validation\Rules\Enum $status
 */
class MediaEloquentModel extends BaseMedia
{

    use HasUlids;

    protected $keyType = 'string';

    public $incrementing = false;


    /**
     * @return int
     */
    public function getHighestOrderNumber(): int
    {
        return (int) $this->where('model_type', $this->model_type)
            ->where('model_id', $this->model_id)
            ->where('collection_name', $this->collection_name)
            ->max($this->determineOrderColumnName());
    }

}

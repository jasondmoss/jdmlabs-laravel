<?php

declare(strict_types=1);

namespace Aenginus\Media\Infrastructure\EloquentModels;

use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ImageEloquentModel extends Model
{

    protected $table = 'images';

    protected $fillable = [
        'hash',
        'path',
        'collection',
        'label',
        'caption',
        'alt',
        'created_at',
        'updated_at',
        'user_id'
    ];

    protected $casts = [
        'responsive_paths' => 'array'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

}

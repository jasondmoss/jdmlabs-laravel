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
        'collection',
        'filename',
        'responsive',
        'width',
        'height',
        'label',
        'alt',
        'caption',
        'created_at',
        'updated_at',
        'imageable_id',
        'imageable_type',
        'user_id'
    ];

    protected $casts = [
        'responsive' => 'array'
    ];

    protected $hidden = ['type'];


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

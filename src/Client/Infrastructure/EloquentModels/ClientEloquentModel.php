<?php

declare(strict_types=1);

namespace Aenginus\Client\Infrastructure\EloquentModels;

use Aenginus\Media\Domain\Models\ImageModel;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Shared\Casts\ConvertNullToEmptyString;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property \Illuminate\Validation\Rules\Enum $status
 */
class ClientEloquentModel extends Model
{

    /**
     * Generated 'permalink' per each client.
     *
     * @var string
     */
    public string $permalink;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'slug',
        'itemprop',
        'website',
        'summary',
        'status',
        'promoted',
        'published_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

    protected $casts = [
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class
    ];

    protected $with = [
        'projects',
        'image'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    final public function projects(): HasMany
    {
        return $this->hasMany(ProjectModel::class, 'client_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    final public function image(): morphOne
    {
        return $this->morphOne(ImageModel::class, 'imageable');
    }

}

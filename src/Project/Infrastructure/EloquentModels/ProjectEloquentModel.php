<?php

declare(strict_types=1);

namespace Aenginus\Project\Infrastructure\EloquentModels;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Shared\Casts\ConvertNullToEmptyString;
use Aenginus\Shared\Enums\Pinned;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Illuminate\Validation\Rules\Enum $status
 */
class ProjectEloquentModel extends Model
{

    protected $table = 'projects';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'subtitle',
        'website',
        'summary',
        'body',
        'client_id',
        'category_id',
        'status',
        'promoted',
        'pinned',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class,
        'pinned' => Pinned::class
    ];

    protected $with = [ 'category' ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function clients(): BelongsTo
    {
        return $this->belongsTo(ClientModel::class, 'client_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\EloquentModels;

use Aenginus\Shared\Casts\ConvertNullToEmptyString;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Illuminate\Validation\Rules\Enum $status
 * @property string $permalink
 */
class ArticleEloquentModel extends Model
{

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'status',
        'promoted',
        'published_at',
        'created_at',
        'updated_at',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class
    ];

    protected $with = [
        'category',
        'media'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(UserEloquentModel::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryEloquentModel::class, 'category_id');
    }

}

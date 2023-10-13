<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\EloquentModels;

use Aenginus\Media\Domain\Models\ImageModel;
use Aenginus\Shared\Casts\ConvertNullToEmptyString;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
        // 'category', // Times out DB  :/
        'signature'
    ];


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
    final public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    final public function signature(): MorphOne
    {
        return $this->morphOne(ImageModel::class, 'imageable')
            ->where('type', 'signature');
    }
}

<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\EloquentModels;

use Aenginus\Article\Infrastructure\Factories\ArticleFactory;
use Aenginus\Shared\Casts\ConvertNullToEmptyString;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Aenginus\Shared\Scopes\FindBySlugScope;
use Aenginus\Shared\Scopes\WherePromotedScope;
use Aenginus\Shared\Scopes\WherePublishedScope;
use Aenginus\Shared\Scopes\WhereRelatedScope;
use Aenginus\Shared\Traits\MediaExtended;
use Aenginus\Shared\Traits\ModelExtended;
use Aenginus\Shared\Traits\Observable;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ArticleEloquentModel extends Model implements HasMedia
{

    use HasEvents, HasFactory, HasSlug, HasUlids, InteractsWithMedia, Observable;

    /** -- Global Helpers */
    use MediaExtended, ModelExtended;

    /** -- Global Scopes */
    use FindBySlugScope, WherePromotedScope, WherePublishedScope, WhereRelatedScope;

    /**
     * Generated 'permalink' per each article, using the published_at
     * date (Y/m/d), upon eloquent model query.
     *
     * @var string
     */
    public string $permalink;

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
     * @return \Aenginus\Article\Infrastructure\Factories\ArticleFactory
     */
    private static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getSlugOptions(): SlugOptions
    {
        /** @see \Aenginus\Shared\Traits\ModelExtended */
        return $this->getCustomSlugOptions();
    }


    /**
     * @return void
     */
    final public function registerMediaCollections(): void
    {
        /** @see \Aenginus\Shared\Traits\MediaExtended */
        $this->registerSignatureImageCollection();
    }


    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    final public function registerMediaConversions(Media|null $media = null): void
    {
        /** @see \Aenginus\Shared\Traits\MediaExtended */
        $this->registerDefaultMediaConversions();
    }


    /**
     * Generate an article 'permalink', facilitating the `generateDates()`
     * method above.
     *
     * @return void
     */
    final public function generatePermalink(): void
    {
        $pubdate = Date::parse($this->published_at)->format('Y/m/d');

        $this->permalink = url("/article/{$pubdate}/$this->slug");
    }


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

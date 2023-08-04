<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Eloquent\Models;

use App\Article\Application\Exceptions\CouldNotFindArticle;
use App\Article\Infrastructure\Factories\ArticleFactory;
use App\Article\Infrastructure\ValueObjects\Id;
use App\Article\Infrastructure\ValueObjects\Slug;
use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use App\Shared\Casts\ConvertNullToEmptyString;
use App\Shared\Enums\Promoted;
use App\Shared\Enums\Status;
use App\Shared\Scopes\FindBySlug;
use App\Shared\Scopes\WherePromoted;
use App\Shared\Scopes\WherePublished;
use App\Shared\Scopes\WhereRelated;
use App\Shared\Traits\MediaExtended;
use App\Shared\Traits\Observable;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;


class ArticleEloquentModel extends Model implements HasMedia
{

    use HasEvents, HasFactory, HasSlug, HasUlids,
        InteractsWithMedia, MediaExtended, Observable,
        /* Scopes */
        FindBySlug, WherePromoted, WherePublished, WhereRelated;

    public $timestamps = true;

    /**
     * Generated 'permalink' per each article, using the published_at
     * date (Y/m/d), upon eloquent model query.
     *
     * @var string
     */
    public string $permalink;

    protected $table = 'articles';

    protected $primaryKey = 'id';

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

    protected $guarded = [];

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
     * @return \App\Article\Infrastructure\Factories\ArticleFactory
     */
    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('signatures')
            ->acceptsMimeTypes([ 'image/jpg', 'image/png', 'image/svg' ])
            ->useFallbackUrl(asset('/images/placeholder/signature.png'))
            ->useFallbackPath(public_path('/images/placeholder/signature.png'));
    }


    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb100')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 250, 250)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->fit(Manipulations::FIT_CROP, 800, 400)
            ->withResponsiveImages()
            ->nonQueued();

        $this->addMediaConversion('detail')
            ->fit(Manipulations::FIT_CROP, 1400, 600)
            ->withResponsiveImages()
            ->nonQueued();
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Database\Eloquent\Builder|self
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function find(string $key): Builder|self
    {
        if (Ulid::isValid($key)) {
            try {
                return $this->newQuery()->find((new Id($key))->value());
            } catch (UnexpectedValueException) {
                throw CouldNotFindArticle::withId($key);
            }
        }

        $slug = (new Slug($key))->value();

        try {
            return $this->newQuery()->slug($slug);
        } catch (UnexpectedValueException) {
            throw CouldNotFindArticle::withSlug($slug);
        }
    }


    /**
     * Generate specific dates for metadata and display purposes.
     *
     * @return void
     */
    public function generateDates(): void
    {
        $this->date = (object) [
            'published' => (object) [
                'iso' => Carbon::parse($this->published_at)->format('c'),
                'display' => Carbon::parse($this->published_at)->format('F j, Y'),
                'path' => Carbon::parse($this->published_at)->format('Y/m/d')
            ],
            'create' => (object) [
                'iso' => Carbon::parse($this->published_at)->format('c'),
                'display' => Carbon::parse($this->published_at)->format('F j, Y')
            ],
            'updated' => (object) [
                'iso' => Carbon::parse($this->published_at)->format('c'),
                'display' => Carbon::parse($this->published_at)->format('F j, Y')
            ]
        ];
    }


    /**
     * Generate an article 'permalink', facilitating the `generateDates()`
     * method above.
     *
     * @return void
     */
    public function generatePermalink(): void
    {
        $this->permalink = url(
            "/article/{$this->date->published->path}/$this->slug"
        );
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEloquentModel::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryEloquentModel::class, 'category_id');
    }

}

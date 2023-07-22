<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use App\Article\Application\Exceptions\CouldNotFindArticle;
use App\Article\Infrastructure\Database\ArticleFactory;
use App\Auth\Infrastructure\User;
use App\Shared\Casts\ConvertNullToEmptyString;
use App\Shared\Enums\Promoted;
use App\Shared\Enums\Status;
use App\Shared\Scopes\FindBySlug;
use App\Shared\Scopes\WherePromoted;
use App\Shared\Scopes\WherePublished;
use App\Shared\Scopes\WhereRelated;
use App\Shared\Traits\Observable;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Slug;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;


class Article extends Model
{

    use HasEvents, HasFactory, HasSlug, HasTags, HasUlids,
        Observable,
        /* Scopes */
        FindBySlug, WherePromoted, WherePublished, WhereRelated;

    public $timestamps = true;

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
        'tags'
    ];


    /**
     * @return \App\Article\Infrastructure\Database\ArticleFactory
     */
    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
     * @param string $key
     *
     * @return self
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function find(string $key): self
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            try {
                return $this->newQuery()->slug($slug);
            } catch (UnexpectedValueException) {
                throw CouldNotFindArticle::withSlug($slug);
            }
        }

        try {
            return $this->newQuery()->find((new Id($key))->value());
        } catch (UnexpectedValueException) {
            throw CouldNotFindArticle::withId($key);
        }
    }

}

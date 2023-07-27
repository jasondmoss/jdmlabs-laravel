<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use App\Article\Application\Exceptions\CouldNotFindArticle;
use App\Article\Infrastructure\Database\ArticleFactory;
use App\Core\Shared\Casts\ConvertNullToEmptyString;
use App\Core\Shared\Enums\Promoted;
use App\Core\Shared\Enums\Status;
use App\Core\Shared\Scopes\FindBySlug;
use App\Core\Shared\Scopes\WherePromoted;
use App\Core\Shared\Scopes\WherePublished;
use App\Core\Shared\Scopes\WhereRelated;
use App\Core\Shared\Traits\Observable;
use App\Core\Shared\ValueObjects\Id;
use App\Core\Shared\ValueObjects\Slug;
use App\Core\User\Infrastructure\User;
use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Keyword\Infrastructure\Keyword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;


class Article extends Model
{

    use HasEvents, HasFactory, HasSlug, HasUlids, Observable,
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
        'category'
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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
     * @return \Illuminate\Database\Eloquent\Builder|\App\Article\Infrastructure\Article
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function find(string $key): Builder|self
    {
        if (Ulid::isValid((new Id($key))->value())) {
            try {
                return $this->newQuery()->find($key);
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

}

<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use App\Article\Infrastructure\Database\ArticleFactory;
use App\Auth\Infrastructure\User;
use App\Shared\Application\Exceptions\CouldNotFindEntry;
use App\Shared\Application\Traits\Observable;
use App\Shared\Domain\Casts\ConvertNullToEmptyString;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
use App\Shared\Domain\ValueObjects\Id;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;


class Article extends Model
{

    use HasEvents, HasFactory, HasSlug, HasTags, HasUlids, Observable;

    public $timestamps = true;

    protected $table = 'articles';

    protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'status',
        'promoted',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class
    ];

    protected $with = [
        'categories'
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
    public function categories(): BelongsTo
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
     * @param string $id
     *
     * @return self
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function find(string $id): self
    {
        $article = $this->newQuery()->find(
            (new Id($id))->value()
        );

        if (! $article instanceof self) {
            throw CouldNotFindEntry::withId($id);
        }

        return $article;
    }

}

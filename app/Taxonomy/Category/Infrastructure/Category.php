<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure;

use App\Article\Infrastructure\Article;
use App\Client\Infrastructure\Client;
use App\Project\Infrastructure\Project;
use App\Shared\Scopes\FindBySlug;
use App\Shared\Scopes\WherePromoted;
use App\Shared\Scopes\WherePublished;
use App\Shared\Scopes\WhereRelated;
use App\Shared\Traits\Observable;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Slug;
use App\Taxonomy\Category\Application\Exceptions\CouldNotFindCategory;
use App\Taxonomy\Category\Infrastructure\Database\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;

class Category extends Model
{

    use HasFactory, HasSlug, HasUlids, Observable,
        /* Scopes */
        FindBySlug, WherePromoted, WherePublished, WhereRelated;


    public $timestamps = true;

    protected $table = "categories";

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug'
    ];


    /**
     * @return \App\Taxonomy\Category\Infrastructure\Database\CategoryFactory
     */
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
     * @return \Illuminate\Database\Eloquent\Builder|\App\Taxonomy\Category\Infrastructure\Category
     * @throws \App\Taxonomy\Category\Application\Exceptions\CouldNotFindCategory
     */
    public function find(string $key): Builder|self
    {
        if (Ulid::isValid((new Id($key))->value())) {
            try {
                return $this->newQuery()->find($key);
            } catch (UnexpectedValueException) {
                throw CouldNotFindCategory::withId($key);
            }
        }

        $slug = (new Slug($key))->value();

        try {
            return $this->newQuery()->slug($slug);
        } catch (UnexpectedValueException) {
            throw CouldNotFindCategory::withSlug($slug);
        }
    }

}

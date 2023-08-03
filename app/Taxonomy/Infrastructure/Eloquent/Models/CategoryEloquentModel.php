<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Eloquent\Models;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Shared\Scopes\FindBySlug;
use App\Shared\Scopes\WherePromoted;
use App\Shared\Scopes\WherePublished;
use App\Shared\Scopes\WhereRelated;
use App\Shared\Traits\Observable;
use App\Taxonomy\Application\Exceptions\CouldNotFindCategory;
use App\Taxonomy\Infrastructure\Factories\CategoryFactory;
use App\Taxonomy\Infrastructure\ValueObjects\Id;
use App\Taxonomy\Infrastructure\ValueObjects\Slug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;

class CategoryEloquentModel extends Model
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
     * @return \App\Taxonomy\Infrastructure\Factories\CategoryFactory
     */
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
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
     * @return \Illuminate\Database\Eloquent\Builder|self
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function find(string $key): Builder|self
    {
        if (Ulid::isValid($key)) {
            try {
                return $this->newQuery()->find((new Id($key))->value());
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(ArticleEloquentModel::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(ClientEloquentModel::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(ProjectEloquentModel::class, 'category_id');
    }

}

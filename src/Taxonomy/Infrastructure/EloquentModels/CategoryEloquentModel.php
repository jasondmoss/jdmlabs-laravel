<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\EloquentModels;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Shared\Scopes\FindBySlug;
use Aenginus\Shared\Scopes\WherePromoted;
use Aenginus\Shared\Scopes\WherePublished;
use Aenginus\Shared\Scopes\WhereRelated;
use Aenginus\Shared\Traits\Observable;
use Aenginus\Taxonomy\Application\Exceptions\CouldNotFindCategory;
use Aenginus\Taxonomy\Infrastructure\Factories\CategoryFactory;
use Aenginus\Taxonomy\Infrastructure\ValueObjects\Id;
use Aenginus\Taxonomy\Infrastructure\ValueObjects\Slug;
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
     * @return \Aenginus\Taxonomy\Infrastructure\Factories\CategoryFactory
     */
    private static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    /**
     * @return string
     */
    final public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Database\Eloquent\Builder|self
     * @throws \Aenginus\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    final public function find(string $key): Builder|self
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
    final public function articles(): HasMany
    {
        return $this->hasMany(ArticleEloquentModel::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    final public function clients(): HasMany
    {
        return $this->hasMany(ClientEloquentModel::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    final public function projects(): HasMany
    {
        return $this->hasMany(ProjectEloquentModel::class, 'category_id');
    }

}

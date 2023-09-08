<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\EloquentModels;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Shared\Scopes\FindBySlugScope;
use Aenginus\Shared\Scopes\WherePromotedScope;
use Aenginus\Shared\Scopes\WherePublishedScope;
use Aenginus\Shared\Scopes\WhereRelatedScope;
use Aenginus\Shared\Traits\ModelExtended;
use Aenginus\Shared\Traits\Observable;
use Aenginus\Taxonomy\Infrastructure\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CategoryEloquentModel extends Model
{

    use HasFactory, HasSlug, HasUlids, Observable;

    /** -- Global Helpers */
    use ModelExtended;

    /** -- Global Scopes */
    use FindBySlugScope, WherePromotedScope, WherePublishedScope, WhereRelatedScope;


    protected $table = "categories";

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
        /** @see \Aenginus\Shared\Traits\ModelExtended */
        return $this->getCustomSlugOptions('name');
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
    final public function projects(): HasMany
    {
        return $this->hasMany(ProjectEloquentModel::class, 'category_id');
    }

}

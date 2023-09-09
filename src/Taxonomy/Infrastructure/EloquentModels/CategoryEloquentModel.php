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
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'slug',
        'user_id'
    ];


    /**
     * @return \Aenginus\Taxonomy\Infrastructure\Factories\CategoryFactory
     */
    /*private static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }*/


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getSlugOptions(): SlugOptions
    {
        /** @see \Aenginus\Shared\Traits\ModelExtended */
        return $this->getCustomSlugOptions('name');
    }


    /**
     * Generate an article 'permalink', facilitating the `generateDates()`
     * method above.
     *
     * @return void
     */
    final public function generatePermalink(): void
    {
        $this->permalink = url("/taxonomy/category/$this->slug");
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(UserEloquentModel::class, 'user_id');
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

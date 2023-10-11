<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Models;

use Aenginus\Shared\Scopes\FindBySlugScope;
use Aenginus\Shared\Scopes\WherePromotedScope;
use Aenginus\Shared\Scopes\WherePublishedScope;
use Aenginus\Shared\Scopes\WhereRelatedScope;
use Aenginus\Shared\Traits\IsModel;
use Aenginus\Shared\Traits\Observable;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CategoryModel extends CategoryEloquentModel
{

    use HasFactory;
    use HasSlug;
    use HasUlids;
    use IsModel;
    use Observable;

    /** -- Global Scopes */
    use FindBySlugScope;
    use WherePromotedScope;
    use WherePublishedScope;
    use WhereRelatedScope;


    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(
            'order',
            static fn (Builder $builder) => $builder->orderBy('name', 'asc')
        );
    }


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
        /** @see \Aenginus\Shared\Traits\IsModel */
        return $this->getCustomSlugOptions('name');
    }

}

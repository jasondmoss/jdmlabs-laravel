<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Models;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Factories\ArticleFactory;
use Aenginus\Shared\Scopes\FindBySlugScope;
use Aenginus\Shared\Scopes\WherePromotedScope;
use Aenginus\Shared\Scopes\WherePublishedScope;
use Aenginus\Shared\Scopes\WhereRelatedScope;
use Aenginus\Shared\Traits\HasImage;
use Aenginus\Shared\Traits\IsModel;
use Aenginus\Shared\Traits\Observable;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ArticleModel extends ArticleEloquentModel
{
    use HasEvents;
    use HasFactory;
    use HasImage;
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
     * Generated 'permalink' per article, using the published_at date (Y/m/d).
     *
     * @var string
     */
    public string $permalink;


    /**
     * @return \Aenginus\Article\Infrastructure\Factories\ArticleFactory
     */
    private static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getSlugOptions(): SlugOptions
    {
        /** @see \Aenginus\Shared\Traits\IsModel */
        return $this->getCustomSlugOptions();
    }
}

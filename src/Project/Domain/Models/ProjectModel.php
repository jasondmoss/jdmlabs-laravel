<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Models;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Factories\ProjectFactory;
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

class ProjectModel extends ProjectEloquentModel
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
     * @var string
     */
    public string $permalink;


    /**
     * @return \Aenginus\Project\Infrastructure\Factories\ProjectFactory
     */
    private static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
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

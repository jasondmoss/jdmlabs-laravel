<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Models;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Factories\ProjectFactory;
use Aenginus\Shared\Scopes\FindBySlugScope;
use Aenginus\Shared\Scopes\WherePromotedScope;
use Aenginus\Shared\Scopes\WherePublishedScope;
use Aenginus\Shared\Scopes\WhereRelatedScope;
use Aenginus\Shared\Traits\MediaExtended;
use Aenginus\Shared\Traits\ModelExtended;
use Aenginus\Shared\Traits\Observable;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProjectModel extends ProjectEloquentModel
{

    use HasEvents, HasFactory, HasSlug, HasUlids, Observable;

    /** -- Global Helpers */
    use MediaExtended, ModelExtended;

    /** -- Global Scopes */
    use FindBySlugScope, WherePromotedScope, WherePublishedScope, WhereRelatedScope;

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
        /** @see \Aenginus\Shared\Traits\ModelExtended */
        return $this->getCustomSlugOptions();
    }

}

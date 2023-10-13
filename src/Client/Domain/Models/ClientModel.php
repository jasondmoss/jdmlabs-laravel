<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Models;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Client\Infrastructure\Factories\ClientFactory;
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

class ClientModel extends ClientEloquentModel
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
     * Generated 'permalink' per client.
     *
     * @var string
     */
    public string $permalink;


    /**
     * @return \Aenginus\Client\Infrastructure\Factories\ClientFactory
     */
    private static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
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

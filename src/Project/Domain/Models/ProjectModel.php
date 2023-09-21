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
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProjectModel extends ProjectEloquentModel implements HasMedia
{

    use HasEvents, HasFactory, HasSlug, HasUlids, InteractsWithMedia, Observable;

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


    /**
     * @return void
     */
    final public function registerMediaCollections(): void
    {
        $this->addMediaCollection('signature')
            ->singleFile()
            ->acceptsMimeTypes([
                'image/jpg',
                'image/png',
                'image/svg'
            ])
            ->useFallbackUrl(asset('/images/placeholder/signature.png'))
            ->useFallbackPath(public_path('/images/placeholder/signature.png'));

        $this->addMediaCollection('showcase')
            ->acceptsMimeTypes([
                'image/jpg',
                'image/png',
                'image/svg'
            ])
            ->useFallbackUrl(asset('/images/placeholder/showcase.png'))
            ->useFallbackPath(public_path('/images/placeholder/showcase.png'));
    }


    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    final public function registerMediaConversions(Media|null $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->fit(Manipulations::FIT_CROP, 800, 400)
            ->withResponsiveImages()
            ->nonQueued();

        $this->addMediaConversion('signature_detail')
            ->fit(Manipulations::FIT_CROP, 1400, 600)
            ->withResponsiveImages()
            ->nonQueued();

        $this->addMediaConversion('showcase_preview')
            ->fit(Manipulations::FIT_CROP, 600, 700)
            ->withResponsiveImages()
            ->nonQueued();

        $this->addMediaConversion('showcase_detail')
            ->fit(Manipulations::FIT_CROP, 1400, 600)
            ->withResponsiveImages()
            ->nonQueued();
    }

}

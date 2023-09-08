<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait MediaExtended
{

    /**
     * @return \Spatie\MediaLibrary\MediaCollections\MediaCollection
     */
    final public function registerLogoImageCollection(): MediaCollection
    {
        return
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/png', 'image/svg'])
            ->useFallbackUrl(asset('/images/placeholder/logo.png'))
            ->useFallbackPath(public_path('/images/placeholder/logo.png'));
    }


    /**
     * @return \Spatie\MediaLibrary\MediaCollections\MediaCollection
     */
    final public function registerSignatureImageCollection(): MediaCollection
    {
        return $this->addMediaCollection('signature')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/png', 'image/svg'])
            ->useFallbackUrl(asset('/images/placeholder/signature.png'))
            ->useFallbackPath(public_path('/images/placeholder/signature.png'));
    }


    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel|\Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel|\Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    final public function registerDefaultMediaConversions(
        Media|null $media = null
    ): ProjectEloquentModel|ArticleEloquentModel|ClientEloquentModel
    {
        $conversions = $this;

        $conversions->addMediaConversion('thumb100')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->nonQueued();

        $conversions->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 250, 250)
            ->nonQueued();

        $conversions->addMediaConversion('card')
            ->fit(Manipulations::FIT_CROP, 800, 400)
            ->withResponsiveImages()
            ->nonQueued();

        $conversions->addMediaConversion('detail')
            ->fit(Manipulations::FIT_CROP, 1400, 600)
            ->withResponsiveImages()
            ->nonQueued();

        return $conversions;
    }


    /**
     * @return string
     */
    final public function getSignatureCard(): string
    {
        return $this->getFirstMediaUrl('signature', 'card');
    }


    /**
     * @return string
     */
    final public function getSignatureDetail(): string
    {
        return $this->getFirstMediaUrl('signature', 'detail');
    }


    /**
     * @return string
     */
    final public function getSignaturePreview(): string
    {
        return $this->getFirstMediaUrl('signature', 'preview');
    }


    /**
     * @return string
     */
    final public function getSignatureThumbnail(): string
    {
        return $this->getFirstMediaUrl('signature', 'thumb100');
    }

}

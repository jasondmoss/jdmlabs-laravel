<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;

trait HasImage
{

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Aenginus\Media\Infrastructure\Entities\ImageEntity $imageEntity
     *
     * @return void
     */
    public function getResponsiveUrls(Model $model, ImageEntity $imageEntity): void
    {
        $folders = collect(config('jdmlabs.base.images'));
    }


    /**
     * @param string $context
     *
     * @return string
     */
    public function defaultPlaceholderImage(string $context): string
    {
        return asset("images/placeholder/{$context}.png");
    }


    /**
     * @return string
     */
    public function getImagePreviewUrl(): string
    {
        return asset(
            "storage/{$this->image->filepath}/preview/{$this->image->filename}"
        );
    }


    /**
     * @return string
     */
    public function getImageThumbnailUrl(): string
    {
        return asset(
            "storage/{$this->image->filepath}/thumbnail/{$this->image->filename}"
        );
    }


    /**
     * @return string
     */
    public function getImageAlt(): string
    {
        return $this->image->alt;
    }

}

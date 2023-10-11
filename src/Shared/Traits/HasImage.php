<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

use Aenginus\Media\Domain\Models\ImageModel;

trait HasImage
{

    /**
     * @param \Aenginus\Media\Domain\Models\ImageModel|null $image
     *
     * @return string
     */
    public function getImageResponsiveUrls(?ImageModel $image = null): string
    {
        if ($image === null) {
            return '';
        }

        $basepath = "images/{$this->getTable()}/{$this->id}/{$image->type}";
        $paths = [];

        $folders = collect(config("jdmlabs.base.images.{$image->type}.responsive"));
        foreach ($folders as $folder => $constraint) {
            $paths[] = asset("storage/{$basepath}/{$folder}/{$this->signature->filename}")
                . " {$constraint[0]}px";
        }

        $paths[] = asset("storage/{$basepath}/{$this->signature->filename}") . ' 1500px';

        return implode(', ', $paths);
    }


    /**
     * @return string
     */
    public function getImagePlaceholderUrl(): string
    {
        return asset("images/placeholder.png");
    }


    /**
     * @param \Aenginus\Media\Domain\Models\ImageModel|null $image
     *
     * @return string
     */
    public function getImagePreviewUrl(?ImageModel $image = null): string
    {
        if ($image === null) {
            return $this->getImagePlaceholderUrl();
        }

        $basepath = "images/{$this->getTable()}/{$this->id}/{$image->type}/preview/";

        return asset("storage/{$basepath}/$image->filename");
    }


    /**
     * @param \Aenginus\Media\Domain\Models\ImageModel|null $image
     *
     * @return string
     */
    public function getImageThumbnailUrl(?ImageModel $image = null): string
    {
        if ($image === null) {
            return $this->getImagePlaceholderUrl();
        }

        $basepath = "images/{$this->getTable()}/{$this->id}/{$image->type}/thumbnail/";

        return asset("storage/{$basepath}/$image->filename");
    }


    /**
     * @param \Aenginus\Media\Domain\Models\ImageModel|null $image
     *
     * @return string
     */
    public function getImageAlt(?ImageModel $image = null): string
    {
        if ($image === null) {
            return __('Placeholder image');
        }

        return $this->signature->alt;
    }

}

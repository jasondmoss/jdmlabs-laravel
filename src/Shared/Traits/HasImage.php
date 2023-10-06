<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait HasImage
{

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


    public function getThumbnail(): string
    {
        return asset(
            "storage/{$this->image->filepath}/thumb/{$this->image->filename}"
        );
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Media\Application;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

final class MediaPathGenerator extends DefaultPathGenerator
{

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getBasePath(Media $media): string
    {
        // Prepend path with the name of the collection.
        parent::getbasepath($media);

        return $media->collection_name . '/' . $media->getKey();
    }

}

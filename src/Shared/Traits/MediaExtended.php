<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

trait MediaExtended
{

    /**
     * @return string
     */
    final public function getImageCard(): string
    {
        return $this->getFirstMediaUrl('signature', 'card');
    }


    /**
     * @return string
     */
    final public function getImageDetail(): string
    {
        return $this->getFirstMediaUrl('signature', 'detail');
    }


    /**
     * @return string
     */
    final public function getImagePreview(): string
    {
        return $this->getFirstMediaUrl('signature', 'preview');
    }


    /**
     * @return string
     */
    final public function getImageThumbnail(): string
    {
        return $this->getFirstMediaUrl('signature', 'thumb100');
    }

}

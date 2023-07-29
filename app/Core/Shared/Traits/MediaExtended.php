<?php

declare(strict_types=1);

namespace App\Core\Shared\Traits;

trait MediaExtended
{

    /**
     * @return string
     */
    public function getImageCard(): string
    {
        return $this->getFirstMediaUrl('signature', 'card');
    }


    /**
     * @return string
     */
    public function getImageDetail(): string
    {
        return $this->getFirstMediaUrl('signature', 'detail');
    }


    /**
     * @return string
     */
    public function getImagePreview(): string
    {
        return $this->getFirstMediaUrl('signature', 'preview');
    }


    /**
     * @return string
     */
    public function getImageThumbnail(): string
    {
        return $this->getFirstMediaUrl('signature', 'thumb100');
    }

}

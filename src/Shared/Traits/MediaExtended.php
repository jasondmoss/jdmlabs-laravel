<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

trait MediaExtended
{

    /**
     * @param string $collection
     *
     * @return string
     */
    final public function getCard(string $collection = 'default'): string
    {
        return $this->getFirstMediaUrl($collection, 'card');
    }


    /**
     * @param string $collection
     *
     * @return string
     */
    final public function getDetail(string $collection = 'default'): string
    {
        return $this->getFirstMediaUrl($collection, 'detail');
    }


    /**
     * @param string $collection
     *
     * @return string
     */
    final public function getThumbnail(string $collection = 'default'): string
    {
        return $this->getFirstMediaUrl($collection, 'thumbnail');
    }

}

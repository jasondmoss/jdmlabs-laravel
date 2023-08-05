<?php

declare(strict_types=1);

namespace Aenginus\Shared\Scopes;

trait WherePublished
{

    /**
     * @param $query
     *
     * @return mixed
     */
    final public function scopePublished($query): mixed
    {
        return $query->where('status', 'published');
    }

}

<?php

declare(strict_types=1);

namespace App\Core\Shared\Scopes;

trait WherePublished
{

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopePublished($query): mixed
    {
        return $query->where('status', 'published');
    }

}
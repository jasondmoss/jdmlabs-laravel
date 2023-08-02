<?php

declare(strict_types=1);

namespace App\Shared\Scopes;

trait WhereRelated
{

    /**
     * @param $query
     * @param $value
     *
     * @return mixed
     */
    public function scopeRelated($query, $value): mixed
    {
        return $query->where('category_id', $value)->published();
    }

}

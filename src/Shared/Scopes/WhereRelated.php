<?php

declare(strict_types=1);

namespace Aenginus\Shared\Scopes;

trait WhereRelated
{

    /**
     * @param $query
     * @param mixed $value
     *
     * @return mixed
     */
    final public function scopeRelated($query, mixed $value): mixed
    {
        return $query->where('category_id', $value)->published();
    }

}

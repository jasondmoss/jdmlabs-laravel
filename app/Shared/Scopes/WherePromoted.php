<?php

declare(strict_types=1);

namespace App\Shared\Scopes;

trait WherePromoted
{

    /**
     * @param $query
     * @param string $value
     *
     * @return mixed
     */
    public function scopePromoted($query, string $value = ''): mixed
    {
        if (! empty($value)) {
            return $query->where('promoted', $value);
        }

        return $query->where('promoted', '=', 'promoted')->get();
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Shared\Scopes;

trait WherePromotedScope
{

    /**
     * @param $query
     * @param string $value
     *
     * @return mixed
     */
    final public function scopePromoted($query, string $value = ''): mixed
    {
        if (! empty($value)) {
            return $query->where('promoted', $value);
        }

        return $query->where('promoted', '=', 'promoted')->get();
    }

}

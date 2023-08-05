<?php

declare(strict_types=1);

namespace Aenginus\Shared\Scopes;

trait FindBySlug
{

    /**
     * @param $query
     * @param string $slug
     *
     * @return mixed
     */
    final public function scopeSlug($query, string $slug): mixed
    {
        return $query->firstWhere('slug', $slug);
    }
}

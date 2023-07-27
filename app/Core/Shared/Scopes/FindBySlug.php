<?php

declare(strict_types=1);

namespace App\Core\Shared\Scopes;

trait FindBySlug
{

    /**
     * @param $query
     * @param string $slug
     *
     * @return mixed
     */
    public function scopeSlug($query, string $slug): mixed
    {
        return $query->firstWhere('slug', $slug);
    }
}

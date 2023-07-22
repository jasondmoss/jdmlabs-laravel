<?php

declare(strict_types=1);

namespace App\Shared\Scopes;

use App\Client\Infrastructure\Client;

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

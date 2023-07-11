<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Domain\Contract;

use App\Taxonomy\Category\Infrastructure\Category;

interface GetContract
{

    /**
     * @param string $key
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function get(string $key): Category;

}

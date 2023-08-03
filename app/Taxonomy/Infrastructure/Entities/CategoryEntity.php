<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Entities;

use App\Taxonomy\Infrastructure\ValueObjects\Id;
use App\Taxonomy\Infrastructure\ValueObjects\Name;

final readonly class CategoryEntity
{

    public ?string $id;

    public ?string $name;


    /**
     * @param object $categoryData
     */
    public function __construct(object $categoryData)
    {
        $this->id = ! empty($categoryData->id)
            ? (new Id($categoryData->id))->value()
            : null;

        $this->name = ! empty($categoryData->name)
            ? (new Name($categoryData->name))->value()
            : null;
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\Entities;

use Aenginus\Taxonomy\Infrastructure\ValueObjects\Id;
use Aenginus\Taxonomy\Infrastructure\ValueObjects\Name;

final readonly class CategoryEntity
{

    public string|null $id;

    public string|null $name;


    /**
     * @param object $categoryData
     */
    public function __construct(object $categoryData)
    {
        $this->id = (new Id($categoryData->id))->value();

        $this->name = (new Name($categoryData->name))->value();
    }

}

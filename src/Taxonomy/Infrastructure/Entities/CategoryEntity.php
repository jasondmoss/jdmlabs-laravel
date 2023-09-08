<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UlidValueObject;

final readonly class CategoryEntity
{

    public string|null $id;
    public string|null $name;


    /**
     * @param object $categoryData
     */
    public function __construct(object $categoryData)
    {
        $this->id = (new UlidValueObject($categoryData->id))->value();
        $this->name = (new StringValueObject($categoryData->name))->value();
    }

}

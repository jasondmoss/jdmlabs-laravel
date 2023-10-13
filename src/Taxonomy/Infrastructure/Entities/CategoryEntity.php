<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UlidValueObject;

final readonly class CategoryEntity
{

    public ?string $id;

    public ?string $name;

    public ?string $parent_id;

    public string $user_id;


    /**
     * @param object $validatedRequest
     */
    public function __construct(object $validatedRequest)
    {
        $this->id = ! empty($validatedRequest->id) ? (new UlidValueObject($validatedRequest->id))->value() : null;

        $this->parent_id = ! empty($validatedRequest->parent_id) ? (new UlidValueObject(
            $validatedRequest->parent_id
        ))->value() : null;

        $this->name = (new StringValueObject($validatedRequest->name))->value();

        $this->user_id = (new UlidValueObject($validatedRequest->user_id))->value();
    }

}

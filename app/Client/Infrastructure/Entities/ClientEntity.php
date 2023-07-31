<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Entities;

use App\Core\Shared\ValueObjects\Id;
use App\Core\Shared\ValueObjects\Itemprop;
use App\Core\Shared\ValueObjects\Name;
use App\Core\Shared\ValueObjects\Summary;
use App\Core\Shared\ValueObjects\Website;

final readonly class ClientEntity
{

    public ?string $id;

    public ?string $user_id;

    public ?string $name;

    public ?string $itemprop;

    public ?string $website;

    public ?string $summary;

    public string $status;

    public string $promoted;


    /**
     * @param object $clientData
     */
    public function __construct(object $clientData)
    {
        $this->id = ! empty($clientData->id)
            ? (new Id($clientData->id))->value()
            : null;

        $this->user_id = ! empty($clientData->user_id)
            ? (new Id($clientData->user_id))->value()
            : null;

        $this->name = ! empty($clientData->name)
            ? (new Name($clientData->name))->value()
            : null;

        $this->itemprop = ! empty($clientData->itemprop)
            ? (new Itemprop($clientData->itemprop))->value()
            : null;

        $this->website = ! empty($clientData->website)
            ? (new Website($clientData->website))->value()
            : null;

        $this->summary = ! empty($clientData->summary)
            ? (new Summary($clientData->summary))->value()
            : null;

        $this->status = $clientData->status;

        $this->promoted = $clientData->promoted;
    }

}

<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Entities;

use App\Client\Infrastructure\ValueObjects\Id;
use App\Client\Infrastructure\ValueObjects\Itemprop;
use App\Client\Infrastructure\ValueObjects\Name;
use App\Client\Infrastructure\ValueObjects\Promoted;
use App\Client\Infrastructure\ValueObjects\Status;
use App\Client\Infrastructure\ValueObjects\Summary;
use App\Client\Infrastructure\ValueObjects\UserId;
use App\Client\Infrastructure\ValueObjects\Website;

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
     *
     * @throws \ReflectionException
     */
    public function __construct(object $clientData)
    {
        $this->id = ! empty($clientData->id)
            ? (new Id($clientData->id))->value()
            : null;

        $this->user_id = ! empty($clientData->user_id)
            ? (new UserId($clientData->user_id))->value()
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

        $this->status = ! empty($clientData->status)
            ? (new Status($clientData->status))->value()
            : null;

        $this->promoted = ! empty($clientData->promoted)
            ? (new Promoted($clientData->promoted))->value()
            : null;
    }

}

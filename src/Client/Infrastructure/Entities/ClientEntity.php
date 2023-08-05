<?php

declare(strict_types=1);

namespace Aenginus\Client\Infrastructure\Entities;

use Aenginus\Client\Infrastructure\ValueObjects\Id;
use Aenginus\Client\Infrastructure\ValueObjects\Itemprop;
use Aenginus\Client\Infrastructure\ValueObjects\Name;
use Aenginus\Client\Infrastructure\ValueObjects\Promoted;
use Aenginus\Client\Infrastructure\ValueObjects\Status;
use Aenginus\Client\Infrastructure\ValueObjects\Summary;
use Aenginus\Client\Infrastructure\ValueObjects\UserId;
use Aenginus\Client\Infrastructure\ValueObjects\Website;

final readonly class ClientEntity
{

    public string|null $id;

    public string|null $user_id;

    public string|null $name;

    public string|null $itemprop;

    public string|null $website;

    public string|null $summary;

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

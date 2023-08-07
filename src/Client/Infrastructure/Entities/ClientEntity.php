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

    public string $user_id;

    public string $name;

    public string $itemprop;

    public string $website;

    public string $summary;

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

        $this->user_id = (new UserId($clientData->user_id))->value();

        $this->name = (new Name($clientData->name))->value();

        $this->itemprop = (new Itemprop($clientData->itemprop))->value();

        $this->website = (new Website($clientData->website))->value();

        $this->summary = (new Summary($clientData->summary))->value();

        $this->status = (new Status($clientData->status))->value();

        $this->promoted = (new Promoted($clientData->promoted))->value();
    }

}

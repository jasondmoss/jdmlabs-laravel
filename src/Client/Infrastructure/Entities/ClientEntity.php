<?php

declare(strict_types=1);

namespace Aenginus\Client\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\PromotedValueObject;
use Aenginus\Shared\ValueObjects\StatusValueObject;
use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Shared\ValueObjects\UrlValueObject;

final readonly class ClientEntity
{
    public ?string $id;
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
            ? (new UlidValueObject($clientData->id))->value()
            : null;
        $this->user_id = (new UlidValueObject($clientData->user_id))->value();
        $this->name = (new StringValueObject($clientData->name))->value();
        $this->itemprop = (new StringValueObject($clientData->itemprop))->value();
        $this->website = (new UrlValueObject($clientData->website))->value();
        $this->summary = (new StringValueObject($clientData->summary))->value();
        $this->status = (new StatusValueObject($clientData->status))->value();
        $this->promoted = (new PromotedValueObject($clientData->promoted))->value();
    }
}

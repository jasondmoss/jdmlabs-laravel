<?php

declare(strict_types=1);

namespace App\Client\Interface;

use App\Client\Infrastructure\Client;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Itemprop;
use App\Shared\ValueObjects\Name;
use App\Shared\ValueObjects\Promoted;
use App\Shared\ValueObjects\Status;
use App\Shared\ValueObjects\Summary;
use App\Shared\ValueObjects\Website;
use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
{

    private mixed $id;

    private mixed $title;

    private mixed $itemprop;

    private mixed $website;

    private mixed $summary;

    private mixed $status;

    private mixed $promoted;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Client::class);
    }


    /**
     * @return \App\Shared\ValueObjects\Id
     */
    public function getId(): Id
    {
        return new Id($this->id);
    }


    /**
     * @return \App\Shared\ValueObjects\Name
     */
    public function getTitle(): Name
    {
        return (new Name($this->title));
    }


    /**
     * @return \App\Shared\ValueObjects\Itemprop
     */
    public function getItemprop(): Itemprop
    {
        return (new Itemprop($this->itemprop));
    }


    /**
     * @return \App\Shared\ValueObjects\Website
     */
    public function getWebsite(): Website
    {
        return (new Website($this->website));
    }


    /**
     * @return \App\Shared\ValueObjects\Summary
     */
    public function getSummary(): Summary
    {
        return (new Summary($this->summary));
    }


    /**
     * @return \App\Shared\ValueObjects\Status
     */
    public function getStatus(): Status
    {
        return (new Status($this->status));
    }


    /**
     * @return \App\Shared\ValueObjects\Promoted
     */
    public function getPromoted(): Promoted
    {
        return (new Promoted($this->promoted));
    }

}

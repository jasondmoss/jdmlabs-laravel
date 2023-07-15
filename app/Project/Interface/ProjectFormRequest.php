<?php

declare(strict_types=1);

namespace App\Project\Interface;

use App\Project\Infrastructure\Project;
use App\Shared\ValueObjects\Body;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Pinned;
use App\Shared\ValueObjects\Promoted;
use App\Shared\ValueObjects\Status;
use App\Shared\ValueObjects\SubTitle;
use App\Shared\ValueObjects\Summary;
use App\Shared\ValueObjects\Title;
use App\Shared\ValueObjects\Website;
use Illuminate\Foundation\Http\FormRequest;

class ProjectFormRequest extends FormRequest
{

    private mixed $id;

    private mixed $title;

    private mixed $subtitle;

    private mixed $website;

    private mixed $summary;

    private mixed $body;

    private mixed $status;

    private mixed $promoted;

    private mixed $pinned;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Project::class);
    }


    /**
     * @return \App\Shared\ValueObjects\Id
     */
    public function getId(): Id
    {
        return (new Id($this->id));
    }


    /**
     * @return \App\Shared\ValueObjects\Title
     */
    public function getTitle(): Title
    {
        return (new Title($this->title));
    }


    /**
     * @return \App\Shared\ValueObjects\SubTitle
     */
    public function getSubTitle(): SubTitle
    {
        return (new SubTitle($this->subtitle));
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
     * @return \App\Shared\ValueObjects\Body
     */
    public function getBody(): Body
    {
        return (new Body($this->body));
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


    /**
     * @return \App\Shared\ValueObjects\Pinned
     */
    public function getPinned(): Pinned
    {
        return (new Pinned($this->pinned));
    }

}

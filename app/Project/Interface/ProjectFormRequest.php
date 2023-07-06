<?php

declare(strict_types=1);

namespace App\Project\Interface;

use App\Project\Infrastructure\ProjectModel;
use App\Shared\Domain\ValueObjects\Body;
use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Pinned;
use App\Shared\Domain\ValueObjects\Promoted;
use App\Shared\Domain\ValueObjects\Status;
use App\Shared\Domain\ValueObjects\SubTitle;
use App\Shared\Domain\ValueObjects\Summary;
use App\Shared\Domain\ValueObjects\Title;
use App\Shared\Domain\ValueObjects\Website;
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
        return $this->user()->can('create', ProjectModel::class);
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Id
     */
    public function getId(): Id
    {
        return (new Id($this->id));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Title
     */
    public function getTitle(): Title
    {
        return (new Title($this->title));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\SubTitle
     */
    public function getSubTitle(): SubTitle
    {
        return (new SubTitle($this->subtitle));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Website
     */
    public function getWebsite(): Website
    {
        return (new Website($this->website));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Summary
     */
    public function getSummary(): Summary
    {
        return (new Summary($this->summary));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Body
     */
    public function getBody(): Body
    {
        return (new Body($this->body));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Status
     */
    public function getStatus(): Status
    {
        return (new Status($this->status));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Promoted
     */
    public function getPromoted(): Promoted
    {
        return (new Promoted($this->promoted));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Pinned
     */
    public function getPinned(): Pinned
    {
        return (new Pinned($this->pinned));
    }

}

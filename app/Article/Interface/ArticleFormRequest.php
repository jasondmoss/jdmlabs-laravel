<?php

declare(strict_types=1);

namespace App\Article\Interface;

use App\Article\Infrastructure\Article;
use App\Shared\Domain\ValueObjects\Body;
use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Promoted;
use App\Shared\Domain\ValueObjects\Status;
use App\Shared\Domain\ValueObjects\Summary;
use App\Shared\Domain\ValueObjects\Title;
use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
{

    private mixed $id;

    private mixed $title;

    private mixed $summary;

    private mixed $body;

    private mixed $promoted;

    private mixed $status;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Article::class);
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

}

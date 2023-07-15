<?php

declare(strict_types=1);

namespace App\Article\Interface\Requests\Http;

use App\Article\Infrastructure\Article;
use App\Shared\ValueObjects\Body;
use App\Shared\ValueObjects\Category;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Promoted;
use App\Shared\ValueObjects\Status;
use App\Shared\ValueObjects\Summary;
use App\Shared\ValueObjects\Title;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    protected string $user_id;

    protected string $title;

    protected string $summary;

    protected string $body;

    protected string $category;

    protected string $status;

    protected string $promoted;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Article::class);
    }


    /**
     * @return \App\Shared\ValueObjects\Id
     */
    public function getUserId(): Id
    {
        return (new Id($this->user_id));
    }


    /**
     * @return \App\Shared\ValueObjects\Title
     */
    public function getTitle(): Title
    {
        return (new Title($this->title));
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
     * @return \App\Shared\ValueObjects\Id
     */
    public function getCategory(): Id
    {
        return (new Id($this->category));
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

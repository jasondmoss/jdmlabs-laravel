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

final class UpdateRequest extends FormRequest
{

    protected mixed $id;

    protected mixed $user_id;

    protected mixed $title;

    protected mixed $summary;

    protected mixed $body;

    protected mixed $category;

    protected mixed $status;

    protected mixed $promoted;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $article = Article::where('id', '=', $this->route('id'))->get()->first();

        return $this->user()->can('update', $article);
    }


    /**
     * @return \App\Shared\ValueObjects\Id
     */
    public function getId(): Id
    {
        return (new Id($this->id));
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
     * @return \App\Shared\ValueObjects\Category
     */
    public function getCategory(): Category
    {
        return (new Category($this->category));
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

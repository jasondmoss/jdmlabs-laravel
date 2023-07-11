<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Interface;

use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Name;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{

    private mixed $id;

    private mixed $name;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Category::class);
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Id
     */
    public function getId(): Id
    {
        return (new Id($this->id));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Name
     */
    public function getName(): Name
    {
        return (new Name($this->name));
    }

}

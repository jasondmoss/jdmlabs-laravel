<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Interface;

use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{

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

}

<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Http;

use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Name;
use App\Taxonomy\Infrastructure\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Category::class);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Id
     */
    public function getId(Request $request): Id
    {
        return (new Id($request->input('id')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Name
     */
    public function getName(Request $request): Name
    {
        return (new Name($request->input('name')));
    }

}

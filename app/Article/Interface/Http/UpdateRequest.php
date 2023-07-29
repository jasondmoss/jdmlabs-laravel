<?php

declare(strict_types=1);

namespace App\Article\Interface\Http;

use App\Article\Infrastructure\Article;
use App\Core\Shared\Enums\Promoted;
use App\Core\Shared\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

final class UpdateRequest extends FormRequest
{

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
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|ulid',
            'user_id' => 'required|ulid',
            'title' => 'required|max:255',
            'summary' => 'required',
            'body' => 'required',
            'category' => 'nullable|ulid',

            'image' => 'sometimes|array',
            'image[file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',
            'image[label]' => 'nullable|string|max:255',
            'image[alt]' => 'nullable|string|max:255',
            'image[caption]' => 'nullable|string|max:255',

            'status' => [ new Enum(Status::class) ],
            'promoted' => [ new Enum(Promoted::class) ],
        ];
    }

}

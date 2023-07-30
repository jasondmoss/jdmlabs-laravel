<?php

declare(strict_types=1);

namespace App\Article\Domain\Validation;

use App\Core\Shared\Enums\Promoted;
use App\Core\Shared\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateSubmissionRules extends FormRequest
{

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
            'promoted' => [ new Enum(Promoted::class) ]
        ];
    }

}

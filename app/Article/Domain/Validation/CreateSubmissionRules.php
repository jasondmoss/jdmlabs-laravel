<?php

declare(strict_types=1);

namespace App\Article\Domain\Validation;

use App\Core\Shared\Enums\Promoted;
use App\Core\Shared\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateSubmissionRules extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|ulid',
            'title' => 'required|max:255',
            'summary' => 'required',
            'body' => 'required',
            'category' => 'nullable|ulid',

            'signature_image' => 'sometimes|array',
            'signature_image[file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',
            'signature_image[label]' => 'nullable|string|max:255',
            'signature_image[alt]' => 'nullable|string|max:255',
            'signature_image[caption]' => 'nullable|string|max:255',

            'status' => [ new Enum(Status::class) ],
            'promoted' => [ new Enum(Promoted::class) ]
        ];
    }

}

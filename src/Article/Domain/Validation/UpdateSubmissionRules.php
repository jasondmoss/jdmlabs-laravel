<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Validation;

use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
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

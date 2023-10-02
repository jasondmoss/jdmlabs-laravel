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

            'signature_image' => 'sometimes|array:collection,label,alt,caption,file',
            'signature_image[collection]' => 'nullable|string|max:255',
            'signature_image[label]' => 'nullable|string|max:255',
            'signature_image[alt]' => 'nullable|string|max:255',
            'signature_image[caption]' => 'nullable|string|max:255',
            'signature_image[file]' => 'sometimes|image',

            'status' => [new Enum(Status::class)],
            'promoted' => [new Enum(Promoted::class)]
        ];
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Validation;

use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
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
            'signature_image[][collection]' => 'nullable|string|max:255',
            'signature_image[][file]' => 'nullable|image|mimes:jpeg,jpg,png',
            'signature_image[][label]' => 'nullable|string|max:255',
            'signature_image[][alt]' => 'nullable|required_with:signature_image[][file]|string|max:255',
            'signature_image[][caption]' => 'nullable|string|max:255',

            'status' => [new Enum(Status::class)],
            'promoted' => [new Enum(Promoted::class)]
        ];
    }
}

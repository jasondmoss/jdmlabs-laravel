<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Validation;

use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateSubmissionRules extends FormRequest
{

    /**
     * @return array
     */
    final public function rules(): array
    {
        return [
            'id' => 'required|ulid',
            'user_id' => 'required|ulid',
            'name' => 'required|max:255',
            'itemprop' => 'required|max:64',
            'website' => 'required|url',
            'summary' => 'required',

            'logo_image' => 'sometimes|array',
            'logo_image[][type]' => 'nullable|string|max:255',
            'logo_image[][file]' => 'nullable|image|mimes:jpeg,jpg,png',
            'logo_image[][label]' => 'nullable|string|max:255',
            'logo_image[][alt]' => 'nullable|required_with:logo_image[][file]|string|max:255',
            'logo_image[][caption]' => 'nullable|string|max:255',

            'status' => [new Enum(Status::class)],
            'promoted' => [new Enum(Promoted::class)]
        ];
    }

}

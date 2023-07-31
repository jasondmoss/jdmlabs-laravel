<?php

declare(strict_types=1);

namespace App\Client\Domain\Validation;

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
            'name' => 'required|max:255',
            'itemprop' => 'required|max:64',
            'website' => 'required|url',
            'summary' => 'required',

            'logo_image' => 'sometimes|array',
            'logo_image[file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',
            'logo_image[label]' => 'nullable|string|max:255',
            'logo_image[alt]' => 'nullable|string|max:255',
            'logo_image[caption]' => 'nullable|string|max:255',

            'status' => [ new Enum(Status::class) ],
            'promoted' => [ new Enum(Promoted::class) ]
        ];
    }

}

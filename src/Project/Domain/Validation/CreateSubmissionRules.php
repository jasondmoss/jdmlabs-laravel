<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Validation;

use Aenginus\Shared\Enums\Pinned;
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
            'subtitle' => 'required|max:255',
            'website' => 'required|url',
            'summary' => 'required',
            'body' => 'required',
            'client_id' => 'required|ulid',
            'category_id' => 'nullable|ulid',

            'signature_image' => 'sometimes|array',
            'signature_image[file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',
            'signature_image[label]' => 'nullable|string|max:255',
            'signature_image[alt]' => 'nullable|string|max:255',
            'signature_image[caption]' => 'nullable|string|max:255',

            'showcase_images' => 'sometimes|array',
            'showcase_images[file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',

            'status' => [ new Enum(Status::class) ],
            'promoted' => [ new Enum(Promoted::class) ],
            'pinned' => [ new Enum(Pinned::class) ]
        ];
    }

}

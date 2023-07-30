<?php

declare(strict_types=1);

namespace App\Project\Domain\Validation;

use App\Core\Shared\Enums\Pinned;
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
            'subtitle' => 'required|max:255',
            'website' => 'required|url',
            'summary' => 'required',
            'body' => 'required',
            'client_id' => 'required|ulid',
            'category' => 'nullable|ulid',

            'signature_image' => 'sometimes|array',
            'signature_image[file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',
            'signature_image[label]' => 'nullable|string|max:255',
            'signature_image[alt]' => 'nullable|string|max:255',
            'signature_image[caption]' => 'nullable|string|max:255',

            'status' => [ new Enum(Status::class) ],
            'promoted' => [ new Enum(Promoted::class) ],
            'pinned' => [ new Enum(Pinned::class) ]
        ];
    }

}

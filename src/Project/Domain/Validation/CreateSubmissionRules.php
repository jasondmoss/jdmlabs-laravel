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

            'signature_image' => 'sometimes|array:collection,file,label,alt,caption',
            'signature_image[collection]' => 'nullable|string|max:255',
            'signature_image[file]' => 'sometimes|image',
            'signature_image[label]' => 'nullable|string|max:255',
            'signature_image[alt]' => 'nullable|required_with:signature_image[file]|string|max:255',
            'signature_image[caption]' => 'nullable|string|max:255',

            'showcase_images' => 'sometimes|array',
            'showcase_images[collection]' => 'nullable|string|max:255',
            'showcase_images[][file]' => 'nullable|image|mimes:gif,jpeg,jpg,png,svg',
            'showcase_images[][label]' => 'nullable|string|max:255',
            'showcase_images[][alt]' => 'nullable|required_with:showcase_images[file]|string|max:255',
            'showcase_images[][caption]' => 'nullable|string|max:255',

            'status' => [new Enum(Status::class)],
            'promoted' => [new Enum(Promoted::class)],
            'pinned' => [new Enum(Pinned::class)]
        ];
    }

}

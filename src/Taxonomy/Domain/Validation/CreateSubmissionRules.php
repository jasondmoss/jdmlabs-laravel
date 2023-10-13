<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Validation;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubmissionRules extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'parent_id' => 'nullable|ulid',
            'user_id' => 'required|ulid'
        ];
    }
}

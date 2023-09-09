<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Validation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubmissionRules extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|ulid',
            'name' => 'required|max:255',
            'user_id' => 'required|ulid'
        ];
    }

}

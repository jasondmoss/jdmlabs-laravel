<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Validation;

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
            'name' => 'required|max:255'
        ];
    }

}

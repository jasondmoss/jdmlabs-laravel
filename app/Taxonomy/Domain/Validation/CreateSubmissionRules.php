<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Validation;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubmissionRules extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255'
        ];
    }

}

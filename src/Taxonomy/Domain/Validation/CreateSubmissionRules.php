<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Validation;

use Illuminate\Foundation\Http\FormRequest;

final class CreateSubmissionRules extends FormRequest
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

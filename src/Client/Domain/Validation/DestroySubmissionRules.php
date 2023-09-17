<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Validation;

use Illuminate\Foundation\Http\FormRequest;

class DestroySubmissionRules extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|ulid',
            'user_id' => 'required|ulid'
        ];
    }

}

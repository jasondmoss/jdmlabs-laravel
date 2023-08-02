<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Web\Requests;

use App\Client\Domain\Validation\CreateSubmissionRules;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

/**
 * @property array $logo_image
 */
final class CreateRequest extends CreateSubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', ClientEloquentModel::class);
    }

}

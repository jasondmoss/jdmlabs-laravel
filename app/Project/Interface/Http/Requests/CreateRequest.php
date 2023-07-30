<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Requests;

use App\Project\Domain\Validation\CreateSubmissionRules;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

/**
 * @property mixed $signature_image
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
        return $this->user()->can('create', ProjectEloquentModel::class);
    }

}

<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Http\Requests;

use App\Taxonomy\Domain\Validation\CreateSubmissionRules;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

class CreateRequest extends CreateSubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', CategoryEloquentModel::class);
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Requests;

use Aenginus\Taxonomy\Domain\Validation\DestroySubmissionRules;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;

class DestroyRequest extends DestroySubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', CategoryEloquentModel::class);
    }

}

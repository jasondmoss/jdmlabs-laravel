<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Requests;

use Aenginus\Project\Domain\Validation\DestroySubmissionRules;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

class DestroyRequest extends DestroySubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', ProjectEloquentModel::class);
    }

}

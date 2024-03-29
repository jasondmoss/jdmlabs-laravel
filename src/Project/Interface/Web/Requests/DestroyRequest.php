<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Requests;

use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Project\Domain\Validation\DestroySubmissionRules;

class DestroyRequest extends DestroySubmissionRules
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', ProjectModel::class);
    }
}

<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Requests;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Domain\Validation\DestroySubmissionRules;

class DestroyRequest extends DestroySubmissionRules
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', CategoryModel::class);
    }
}

<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Requests;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Domain\Validation\CreateSubmissionRules;

final class CreateRequest extends CreateSubmissionRules
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', CategoryModel::class);
    }
}

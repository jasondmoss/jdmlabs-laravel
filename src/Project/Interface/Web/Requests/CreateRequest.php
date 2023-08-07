<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Requests;

use Aenginus\Project\Domain\Validation\CreateSubmissionRules;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

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

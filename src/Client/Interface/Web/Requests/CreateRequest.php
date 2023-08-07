<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Requests;

use Aenginus\Client\Domain\Validation\CreateSubmissionRules;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

/**
 * @property array $logo_image
 */
class CreateRequest extends CreateSubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return $this->user()->can('create', ClientEloquentModel::class);
    }

}

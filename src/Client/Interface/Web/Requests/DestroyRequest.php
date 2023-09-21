<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Requests;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Domain\Validation\DestroySubmissionRules;

class DestroyRequest extends DestroySubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', ClientModel::class);
    }

}

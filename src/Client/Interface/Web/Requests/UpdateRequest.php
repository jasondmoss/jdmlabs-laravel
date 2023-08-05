<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Requests;

use Aenginus\Client\Domain\Validation\UpdateSubmissionRules;
use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

/**
 * @property array $logo_image
 * @property string $listing_page
 */
final class UpdateRequest extends UpdateSubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', ClientEloquentModel::class);
    }

}

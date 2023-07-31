<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Requests;

use App\Client\Domain\Validation\UpdateSubmissionRules;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

/**
 * @property array $logo_image
 * @property string $listing_page
 */
class UpdateRequest extends UpdateSubmissionRules
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
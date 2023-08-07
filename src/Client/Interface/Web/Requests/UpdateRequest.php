<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Requests;

use Aenginus\Client\Domain\Validation\UpdateSubmissionRules;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

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
    final public function authorize(): bool
    {
        $client = ClientEloquentModel::where('id', '=', $this->route('id'))
            ->get()
            ->first();

        return $this->user()->can('update', $client);
    }

}

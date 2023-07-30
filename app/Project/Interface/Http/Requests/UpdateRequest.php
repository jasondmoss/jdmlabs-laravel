<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Requests;

use App\Project\Domain\Validation\UpdateSubmissionRules;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

/**
 * @property mixed $signature_image
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
        $project = ProjectEloquentModel::where('id', '=', $this->route('id'))
            ->get()
            ->first();

        return $this->user()->can('update', $project);
    }

}

<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Web\Requests;

use App\Taxonomy\Domain\Validation\UpdateSubmissionRules;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

/**
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
        $category = CategoryEloquentModel::where('id', '=', $this->route('id'))
            ->get()
            ->first();

        return $this->user()->can('update', $category);
    }

}

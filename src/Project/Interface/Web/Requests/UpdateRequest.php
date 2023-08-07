<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Requests;

use Aenginus\Project\Domain\Validation\UpdateSubmissionRules;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

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

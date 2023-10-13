<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Requests;

use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Project\Domain\Validation\UpdateSubmissionRules;

/**
 * @property mixed $showcase_images
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
        $project = ProjectModel::where('id', '=', $this->route('id'))->get()->first();

        return $this->user()->can('update', $project);
    }
}

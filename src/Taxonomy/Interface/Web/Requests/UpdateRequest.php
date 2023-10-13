<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Requests;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Domain\Validation\UpdateSubmissionRules;

/**
 * @property string $listing_page
 */
final class UpdateRequest extends UpdateSubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function authorize(): bool
    {
        $category = CategoryModel::where('id', '=', $this->route('id'))->get()->first();

        return $this->user()->can('update', $category);
    }

}

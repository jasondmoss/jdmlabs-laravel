<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Requests;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Domain\Validation\CreateSubmissionRules;

/**
 * @property array $signature_image
 */
final class CreateRequest extends CreateSubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', ArticleModel::class);
    }

}

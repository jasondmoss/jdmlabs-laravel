<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Requests;

use Aenginus\Article\Domain\Validation\DestroySubmissionRules;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;

/**
 * @property array $signature_image
 */
final class DestroyRequest extends DestroySubmissionRules
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('delete', ArticleEloquentModel::class);
    }

}

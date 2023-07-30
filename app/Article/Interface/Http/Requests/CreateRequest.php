<?php

declare(strict_types=1);

namespace App\Article\Interface\Http\Requests;

use App\Article\Domain\Validation\CreateSubmissionRules;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

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
        return $this->user()->can('create', ArticleEloquentModel::class);
    }

}

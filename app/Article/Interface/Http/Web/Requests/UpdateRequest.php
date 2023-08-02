<?php

declare(strict_types=1);

namespace App\Article\Interface\Http\Web\Requests;

use App\Article\Domain\Validation\UpdateSubmissionRules;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

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
        $article = ArticleEloquentModel::where('id', '=', $this->route('id'))
            ->get()
            ->first();

        return $this->user()->can('update', $article);
    }

}

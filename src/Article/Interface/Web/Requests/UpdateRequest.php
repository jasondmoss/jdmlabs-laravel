<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Requests;

use Aenginus\Article\Domain\Validation\UpdateSubmissionRules;
use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

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

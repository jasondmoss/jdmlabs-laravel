<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Traits;

use App\Taxonomy\Infrastructure\Term;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTaxonomyablesToMany {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function termsToMany(): MorphToMany
    {
        $related = Term::class;

        return $this->morphToMany($related, 'termable');
    }

}

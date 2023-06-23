<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Traits;

use App\Taxonomy\Infrastructure\Term;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTaxonomies {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function terms(): MorphToMany
    {
        $related = Term::class;

        return $this->morphToMany($related, 'termable');
    }


    /**
     * @param $vocabulary
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function termsByVocabulary($vocabulary): MorphToMany
    {
        return $this->terms()->where('vocabulary', $vocabulary);
    }


    /**
     * @param $foreignKey
     * @param $ownerKey
     * @param $relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function term(
        $foreignKey = null,
        $ownerKey = null,
        $relation = null
    ): BelongsTo
    {
        $related = Term::class;

        return $this->belongsTo($related, $foreignKey, $ownerKey, $relation);
    }


    /**
     * @param $query
     * @param array $taxonomies
     * @param string $termKey
     *
     * @return void
     */
    public function scopeByTaxonomies(
        $query,
        array $taxonomies,
        string $termKey = 'id'
    ): void
    {
        foreach ($taxonomies as $vocabulary => $terms) {
            $terms = is_array($terms) ? $terms : [$terms];
            $terms = array_filter($terms);

            if (count($terms)) {
                $query->whereHas(
                    'terms',
                    fn ($t) => $t->where('vocabulary', $vocabulary)
                        ->whereIn($termKey, $terms)
                );
            }
        }
    }


    /**
     * @param $query
     * @param $vocabulary
     *
     * @return mixed
     */
    public function scopeTermsByVocabulary($query, $vocabulary): mixed
    {
        return $query->whereHas(
            'terms',
            fn ($t) => $t->where('vocabulary', $vocabulary)
        );
    }

}

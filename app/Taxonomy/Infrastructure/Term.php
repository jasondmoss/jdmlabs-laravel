<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use App\Taxonomy\Infrastructure\Scopes\WeightScope;
use App\Taxonomy\Infrastructure\Traits\HasTaxonomies;
use App\Taxonomy\Infrastructure\Traits\HasTaxonomyablesToMany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kalnoy\Nestedset\NodeTrait;

class Term extends Model
{

    use HasTaxonomies, HasTaxonomyablesToMany, HasUlids, NodeTrait;

    protected $guarded = [
        'id'
    ];


    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new WeightScope());
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function termsByMany(): MorphToMany
    {
        $related = Term::class;

        return $this->morphedByMany($related, 'termable');
    }


    /**
     * @param $query
     * @param $vocabulary
     *
     * @return void
     */
    public function scopeByVocabulary($query, $vocabulary): void
    {
        $query->where('vocabulary', $vocabulary);
    }


    /**
     * @return array
     */
    public function getVocabulary(): array
    {
        //        $vocabularies = config('jdmlabs.taxonomy.vocabularies', []);
        $vocabularies = [];

        return $vocabularies[ $this->vocabulary ] ?? [];
    }

}

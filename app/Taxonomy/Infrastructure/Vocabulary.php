<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use App\Taxonomy\Application\Events;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Vocabulary extends Model {

    public $timestamps = false;

    public $fillable = [
        'name',
        'description'
    ];

    /**
     * Model events.
     */
    protected $dispatchesEvents = [
        'created' => Events\TaxonomyCreatedEvent::class,
        'updated' => Events\TaxonomyUpdatedEvent::class,
        'deleted' => Events\TaxonomyDeletedEvent::class
    ];

    /**
     * Validation rules
     *
     * @see http://laravel.com/docs/5.5/validation
     * @var array
     */
    public static array $rules = [
        'name' => 'required|max:80|unique:vocabularies',
        'description' => 'max:1000'
    ];


    /**
     * Return the Terms relationship ordered by Term weight.
     */
    public function terms(): HasMany
    {
        return $this->hasMany(Term::class, 'vocabulary_id')
            ->orderBy('weight')
            ->orderBy('name');
    }


    /**
     * @param $id
     *
     * @return bool
     */
    public function hasTermId($id): bool
    {
        return $this->terms()->where('id', $id)->exists();
    }


    /**
     * Returns a collection of the vocabulary's root terms.
     *
     * Root terms are top-level terms with no parent.
     *
     * @return \Illuminate\Support\Collection
     */
    public function rootTerms(): Collection
    {
        if ($this->terms) {
            return $this->terms
                ->where('parent_id', '')
                ->sortBy([
                    'weight',
                    'name'
                ]);
        }

        return new Collection();
    }


    /**
     * Returns the root terms formatted as a string:
     *   name | description
     */
    public function rootTermsFormValue(): string
    {
        $string = '';

        foreach ($this->rootTerms() as $term) {
            $string .= $term->name . ' | ' . $term->description . "\n";
        }

        return $string;
    }

}

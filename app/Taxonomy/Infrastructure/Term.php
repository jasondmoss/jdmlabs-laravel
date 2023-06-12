<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use App\Taxonomy\Application\Events;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\NodeTrait;

class Term extends Model {

    use NodeTrait;


    /**
     * Self-validation rules.
     *
     * @var array
     */
    public static array $rules = [
        'name' => 'required|max:80',
        'description' => 'nullable|max:1000',
        'url' => 'nullable|url|max:1000',
        'vocabulary_id' => 'required|integer',
        'is_active' => 'boolean',
        'weight' => 'integer'
    ];

    /**
     * Attributes that can be mass-assigned.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'description',
        'url',
        'vocabulary_id',
        'parent_id',
        'is_active',
        'legacy_id',
        'weight'
    ];


    /**
     * Model events
     *
     * @var array
     */
//    protected $dispatchesEvents = [
//        'created' => Events\TaxonomyCreatedEvent::class,
//        'updated' => Events\TaxonomyUpdatedEvent::class,
//        'deleted' => Events\TaxonomyDeletedEvent::class
//    ];


    /**
     * Creates terms from a string of text as children of the provided
     * Term object and returns them as a collection.
     *
     * String format:
     *   term | description
     *   term | description
     *
     * @param string $text - the string containing term info
     * @param Term $parent - parent for the created terms
     *
     * @return Collection
     * @throws \Throwable
     */
    public static function makeChildrenFromText(string $text, Term $parent): Collection
    {
        $weight = 1;
        $terms = new Collection();

        foreach (self::parseText($text) as $attributes) {
            $term = new Term($attributes);

            $term->vocabulary_id = $parent->vocabulary_id;
            $term->parent_id = $parent->id;
            $term->weight = $weight;

            $term->saveOrFail();

            $terms->push($term);
        }

        return $terms;
    }


    /**
     * Converts a string of formatted text into an array of term attribute arrays
     *
     * @param string $text
     *
     * @return array
     * @example
     *   term | description
     *   term | description
     *  becomes
     *   [
     *      ['name'=>term,'description'=>description],
     *      ['name'=>term,'description'=>description],
     *   ]
     */
    protected static function parseText(string $text): array
    {
        $terms = [];
        $lines = preg_split("/(\r\n|\n|\r)/", $text);

        foreach ($lines as $line) {
            $parts = explode('|', $line, 2);

            $terms[] = [
                'name' => trim($parts[0]),
                'description' => isset($parts[1]) ? trim($parts[1]) : ''
            ];
        }

        return $terms;
    }


    /**
     * Creates a collection of terms from a string of text containing one term per line
     *
     * @param string $text - the string containing term info
     * @param integer $vocabulary_id
     *
     * @return Collection
     * @throws
     * @example
     *   term | description
     *   term | description
     *
     */
    public static function makeFromText(string $text, int $vocabulary_id): Collection
    {
        $weight = 1;
        $terms = new Collection();

        foreach (self::parseText($text) as $attributes) {
            $term = new Term($attributes);

            $term->vocabulary_id = $vocabulary_id;
            $term->weight = $weight;

            $term->saveOrFail();

            $terms->push($term);
        }

        return $terms;
    }


    /**
     * @param array $attributes
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public static function form(array $attributes): View
    {
        $term = isset($attributes['id'])
            ? static::find($attributes['id'])
            : new static($attributes);

        if (! $term->vocabulary_id) {
            throw new Exception('Vocabulary_id is required when adding a taxonomy term.');
        }

        return View::make('taxonomy::terms.form')->with('term', $term);
    }


    /**
     * Answer whether the url attribute is set and a valid url.
     *
     * @return bool
     */
    public function hasUrl(): bool
    {
        return ($this->url && (
            filter_var($this->url, FILTER_VALIDATE_URL) !== false
        ));
    }


    /**
     * Answer whether the term is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->getAttribute('is_active');
    }


    /**
     * @param Term $term
     */
    public function addChild(Term $term): void
    {
        // To make sure vocabulary id matches
        $this->vocabulary->terms()->save($term);

        $this->appendNode($term);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vocabulary(): BelongsTo
    {
        return $this->belongsTo(Vocabulary::class, 'vocabulary_id');
    }


    /**
     * @return string
     */
    public function getLftName(): string
    {
        return 'left';
    }


    /**
     * @return string
     */
    public function getRgtName(): string
    {
        return 'right';
    }


    /**
     * @return string
     */
    public function getParentIdName(): string
    {
        return 'parent_id';
    }


    /**
     * Set the value of model's parent id key.
     *
     * @throws \Exception If parent node doesn't exists
     */
    public function setParentAttribute($value): void
    {
        $this->setParentIdAttribute($value);
    }


    /**
     * Returns array of attributes suitable for api clients
     *
     * @return array
     */
    public function apiArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'url' => $this->url,
            'vocabulary_id' => $this->vocabulary_id,
            'weight' => $this->weight
        ];
    }

}

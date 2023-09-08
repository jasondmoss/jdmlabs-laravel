<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

use Aenginus\Shared\Exceptions\CouldNotFindModelEntity;
use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;

trait ModelExtended
{

    /**
     * @return object
     */
    private function generateCreateDate(): object
    {
        return (object) [
            'iso' => Date::parse($this->published_at)->format('c'),
            'display' => Date::parse($this->published_at)->format('F j, Y')
        ];
    }


    /**
     * @return object
     */
    private function generatePublishDate(): object
    {
        return (object) [
            'iso' => Date::parse($this->published_at)->format('c'),
            'display' => Date::parse($this->published_at)->format('F j, Y')
        ];
    }


    /**
     * @return object
     */
    private function generateUpdateDate(): object
    {
        return (object) [
            'iso' => Date::parse($this->published_at)->format('c'),
            'display' => Date::parse($this->published_at)->format('F j, Y')
        ];
    }


    /**
     * @param string $fieldName
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getCustomSlugOptions(string $fieldName = 'title'): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($fieldName)
            ->saveSlugsTo('slug');
    }


    /**
     * @return string
     */
    final public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    final public function find(string $key): Builder|self
    {
        if (Ulid::isValid($key)) {
            try {
                return $this->newQuery()->find((new UlidValueObject($key))->value());
            } catch (UnexpectedValueException) {
                throw CouldNotFindModelEntity::withId($key);
            }
        }

        $slug = (new StringValueObject($key))->value();

        try {
            return $this->newQuery()->slug($slug);
        } catch (UnexpectedValueException) {
            throw CouldNotFindModelEntity::withSlug($slug);
        }
    }


    /**
     * Generate specific dates for metadata and display purposes.
     *
     * @return void
     */
    final public function entityDates(): void
    {
        $this->date = (object) [
            'published' => $this->generatePublishDate(),
            'create' => $this->generateCreateDate(),
            'updated' => $this->generateUpdateDate()
        ];
    }

}

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

trait IsModel
{

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
    private function generateUpdateDate(): object
    {
        return (object) [
            'iso' => Date::parse($this->published_at)->format('c'),
            'display' => Date::parse($this->published_at)->format('F j, Y')
        ];
    }


    /**
     * Generate an 'permalink' for the requesting entity.
     *
     * @param string $entity
     *
     * @return void
     */
    final public function generatePermalink(string $entity = ''): void
    {
        $this->permalink = match ($entity) {
            'article' => url(
                "/article/" . Date::parse($this->date->published->iso)->format('Y/m/d') . "/" . $this->slug
            ),
            'client' => url("/client/$this->slug"),
            'project' => url("/project/{$this->clients->slug}/$this->slug"),
            default => url("/$this->slug")
        };
    }


    /**
     * @param string $fieldName
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getCustomSlugOptions(string $fieldName = 'title'): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom($fieldName)->saveSlugsTo('slug');
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

}

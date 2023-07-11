<?php

declare(strict_types=1);

namespace App\Project\Infrastructure;

use App\Auth\Infrastructure\User;
use App\Client\Infrastructure\Client;
use App\Project\Infrastructure\Database\ProjectFactory;
use App\Shared\Application\Exceptions\CouldNotFindEntry;
use App\Shared\Application\Traits\Observable;
use App\Shared\Domain\Casts\ConvertNullToEmptyString;
use App\Shared\Domain\Enums\Pinned;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{

    use HasEvents, HasFactory, HasSlug, HasUlids, Observable;

    public $timestamps = true;

    protected $table = 'projects';

    protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'website',
        'summary',
        'body',
        'status',
        'promoted',
        'pinned',
        'client_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class,
        'pinned' => Pinned::class
    ];

    protected $with = [];


    /**
     * @return \App\Project\Infrastructure\Database\ProjectFactory
     */
    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * @param string $id
     *
     * @return self
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function find(string $id): self
    {
        $project = $this->newQuery()->find(
            (new Id($id))->value()
        );

        if (! $project instanceof self) {
            throw CouldNotFindEntry::withId($id);
        }

        return $project;
    }

}

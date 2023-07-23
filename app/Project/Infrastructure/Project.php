<?php

declare(strict_types=1);

namespace App\Project\Infrastructure;

use App\Auth\Infrastructure\User;
use App\Client\Infrastructure\Client;
use App\Project\Application\Exceptions\CouldNotFindProject;
use App\Project\Infrastructure\Database\ProjectFactory;
use App\Shared\Casts\ConvertNullToEmptyString;
use App\Shared\Enums\Pinned;
use App\Shared\Enums\Promoted;
use App\Shared\Enums\Status;
use App\Shared\Scopes\FindBySlug;
use App\Shared\Scopes\WherePromoted;
use App\Shared\Scopes\WherePublished;
use App\Shared\Scopes\WhereRelated;
use App\Shared\Traits\Observable;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Slug;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;

class Project extends Model
{

    use HasEvents, HasFactory, HasSlug, HasTags, HasUlids,
        Observable,
        /* Scopes */
        FindBySlug, WherePromoted, WherePublished, WhereRelated;

    public $timestamps = true;

    protected $table = 'projects';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'subtitle',
        'website',
        'summary',
        'body',
        'client_id',
        'status',
        'promoted',
        'pinned',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class,
        'pinned' => Pinned::class
    ];

    protected $with = [
        'clients',
        'tags'
    ];


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
     * @param string $key
     *
     * @return self
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function find(string $key): self
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            try {
                return $this->newQuery()->slug($slug);
            } catch (UnexpectedValueException) {
                throw CouldNotFindProject::withSlug($slug);
            }
        }

        try {
            return $this->newQuery()->find((new Id($key))->value());
        } catch (UnexpectedValueException) {
            throw CouldNotFindProject::withId($key);
        }
    }

}

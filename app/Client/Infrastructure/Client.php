<?php

declare(strict_types=1);

namespace App\Client\Infrastructure;

use App\Auth\Infrastructure\User;
use App\Client\Application\Exceptions\CouldNotFindClient;
use App\Client\Infrastructure\Database\ClientFactory;
use App\Project\Infrastructure\Project;
use App\Shared\Casts\ConvertNullToEmptyString;
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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;

class Client extends Model
{

    use HasEvents,HasFactory,HasSlug, HasTags, HasUlids,
        Observable,
        /* Scopes */
        FindBySlug, WherePromoted, WherePublished, WhereRelated;

    public $timestamps = true;

    protected $table = 'clients';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'itemprop',
        'website',
        'summary',
        'status',
        'promoted',
        'published_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

    protected $guarded = [];

    protected $casts = [
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class
    ];

    protected $with = [
        'projects',
        'tags'
    ];


    /**
     * @return \App\Client\Infrastructure\Database\ClientFactory
     */
    protected static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
     * @return \App\Client\Infrastructure\Client
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function find(string $key): self
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            try {
                return $this->newQuery()->slug($slug);
            } catch (UnexpectedValueException) {
                throw CouldNotFindClient::withSlug($slug);
            }
        }

        try {
            return $this->newQuery()->find((new Id($key))->value());
        } catch (UnexpectedValueException) {
            throw CouldNotFindClient::withId($key);
        }
    }

}

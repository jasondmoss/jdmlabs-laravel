<?php

declare(strict_types=1);

namespace Aenginus\Client\Infrastructure\Eloquent\Models;

use Aenginus\Client\Application\Exceptions\CouldNotFindClient;
use Aenginus\Client\Infrastructure\Factories\ClientFactory;
use Aenginus\Client\Infrastructure\ValueObjects\Id;
use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Aenginus\Shared\Casts\ConvertNullToEmptyString;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Aenginus\Shared\Scopes\FindBySlug;
use Aenginus\Shared\Scopes\WherePromoted;
use Aenginus\Shared\Scopes\WherePublished;
use Aenginus\Shared\Scopes\WhereRelated;
use Aenginus\Shared\Traits\MediaExtended;
use Aenginus\Shared\Traits\Observable;
use Aenginus\Taxonomy\Infrastructure\ValueObjects\Slug;
use Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\Uid\Ulid;
use UnexpectedValueException;

class ClientEloquentModel extends Model implements HasMedia
{

    use HasEvents, HasFactory, HasSlug, HasUlids,
        InteractsWithMedia, MediaExtended, Observable,
        /* Scopes */
        FindBySlug, WherePromoted, WherePublished, WhereRelated;

    public $timestamps = true;

    public string $permalink;

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
        'projects'
    ];


    /**
     * @return \Aenginus\Client\Infrastructure\Factories\ClientFactory
     */
    private static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }


    /**
     * @return \Spatie\Sluggable\SlugOptions
     */
    final public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
     * @return void
     */
    final public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logos')
            /*->singleFile()*/
            ->acceptsMimeTypes(['image/jpg', 'image/png', 'image/svg'])
            ->useFallbackUrl(asset('/images/placeholder/logo.png'))
            ->useFallbackPath(public_path('/images/placeholder/logo.png'));
    }


    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    final public function registerMediaConversions(Media|null $media = null): void
    {
        $this->addMediaConversion('thumb100')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 250, 250)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->fit(Manipulations::FIT_CROP, 800, 400)
            ->withResponsiveImages()
            ->nonQueued();

        $this->addMediaConversion('detail')
            ->fit(Manipulations::FIT_CROP, 1400, 600)
            ->withResponsiveImages()
            ->nonQueued();
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Database\Eloquent\Builder|self
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
     */
    final public function find(string $key): Builder|self
    {
        if (Ulid::isValid($key)) {
            try {
                return $this->newQuery()->find((new Id($key))->value());
            } catch (UnexpectedValueException) {
                throw CouldNotFindClient::withId($key);
            }
        }

        $slug = (new Slug($key))->value();

        try {
            return $this->newQuery()->slug($slug);
        } catch (UnexpectedValueException) {
            throw CouldNotFindClient::withSlug($slug);
        }
    }


    /**
     * Generate a client 'permalink'.
     *
     * @return void
     */
    final public function generatePermalink(): void
    {
        $this->permalink = url("/client/$this->slug");
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(UserEloquentModel::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    final public function projects(): HasMany
    {
        return $this->hasMany(ProjectEloquentModel::class, 'client_id');
    }

}

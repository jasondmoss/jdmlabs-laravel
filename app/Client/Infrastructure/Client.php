<?php

declare(strict_types=1);

namespace App\Client\Infrastructure;

use App\Auth\Infrastructure\User;
use App\Project\Infrastructure\Project;
use App\Shared\Application\Exceptions\CouldNotFindEntry;
use App\Shared\Application\Traits\Observable;
use App\Shared\Domain\Casts\ConvertNullToEmptyString;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model {

    use HasEvents, HasFactory, HasUlids, Observable;

    public $timestamps = true;

    protected $table = 'clients';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug',
        'itemprop',
        'website',
        'summary',
        'status',
        'promoted',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class
    ];

    protected $with = [ 'projects' ];


    /**
     * @return \App\Client\Infrastructure\ClientFactory
     */
    protected static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }


    /**
     * @param string $id
     *
     * @return self
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function find(string $id): self
    {
       $article = $this->newQuery()->find($id);

       if (! $article instanceof self) {
           throw CouldNotFindEntry::withId($id);
       }

       return $article;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
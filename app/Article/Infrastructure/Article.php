<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use App\Auth\Infrastructure\User;
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

class Article extends Model {

    use HasEvents, HasFactory, HasUlids, Observable;

    public $timestamps = true;

    protected $table = 'articles';

    protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'status',
        'promoted',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'body' => ConvertNullToEmptyString::class,
        'summary' => ConvertNullToEmptyString::class,
        'published_at' => 'immutable_datetime',
        'status' => Status::class,
        'promoted' => Promoted::class
    ];

    protected $with = [];


    /**
     * @return \App\Article\Infrastructure\ArticleFactory
     */
    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

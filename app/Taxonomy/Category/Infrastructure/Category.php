<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure;

use App\Article\Infrastructure\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasSlug;

class Category extends Model
{

    use HasSlug;


    public $timestamps = true;

    protected $table = "categories";

    protected $fillable = [
        'name'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
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

}

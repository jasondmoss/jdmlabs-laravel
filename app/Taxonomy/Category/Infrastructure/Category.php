<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure;

use App\Article\Infrastructure\Article;
use App\Taxonomy\Category\Infrastructure\Database\CategoryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{

    use HasFactory, HasSlug, HasUlids;


    public $timestamps = true;

    protected $table = "categories";

    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [];

    /*protected $with = [
        'articles'
    ];*/


    /**
     * @return \App\Taxonomy\Category\Infrastructure\Database\CategoryFactory
     */
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
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

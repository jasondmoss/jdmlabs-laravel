<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ArticleCategory extends Model implements Sortable
{

    use HasFactory, HasSlug, SortableTrait;


    protected $fillable = [
        'name',
        'slug'
    ];

    protected $hidden = [
        'order_column'
    ];


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

}

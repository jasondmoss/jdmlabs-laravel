<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\EloquentModels;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryEloquentModel extends Model
{

    protected $table = "categories";

    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];


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
    final public function articles(): HasMany
    {
        return $this->hasMany(ArticleModel::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    final public function projects(): HasMany
    {
        return $this->hasMany(ProjectModel::class, 'category_id');
    }

}

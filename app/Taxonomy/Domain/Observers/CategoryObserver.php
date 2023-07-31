<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Observers;

use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Illuminate\Support\Facades\App;

final readonly class CategoryObserver
{

    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function creating(CategoryEloquentModel $category): void
    {
        if (! App::runningInConsole()) {
            $category->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function created(CategoryEloquentModel $category): void {}


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function deleting(CategoryEloquentModel $category): void {}


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function deleted(CategoryEloquentModel $category): void {}


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function updating(CategoryEloquentModel $category): void {}


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function updated(CategoryEloquentModel $category): void {}
}

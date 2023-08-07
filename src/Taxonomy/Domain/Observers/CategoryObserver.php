<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Observers;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;

final readonly class CategoryObserver
{

    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function creating(CategoryEloquentModel $category): void
    {
        /*if (! App::runningInConsole()) {
            $category->user_id = auth()->user()->id;
        }*/
    }


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function created(CategoryEloquentModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function deleting(CategoryEloquentModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function deleted(CategoryEloquentModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function updating(CategoryEloquentModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function updated(CategoryEloquentModel $category): void {}

}

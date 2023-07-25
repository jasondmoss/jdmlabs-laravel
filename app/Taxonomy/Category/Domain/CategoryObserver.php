<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Domain;

use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Support\Facades\App;

final readonly class CategoryObserver
{

    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function creating(Category $category): void
    {
        if (! App::runningInConsole()) {
            $category->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function created(Category $category): void {}


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function deleting(Category $category): void {}


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function deleted(Category $category): void {}


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function updating(Category $category): void {}


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function updated(Category $category): void {}
}

<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Observers;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;

final readonly class CategoryObserver
{

    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
    public function creating(CategoryModel $category): void
    {
        /*if (! App::runningInConsole()) {
            $category->user_id = auth()->user()->id;
        }*/
    }


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
//    public function created(CategoryModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
//    public function deleting(CategoryModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
//    public function deleted(CategoryModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
//    public function updating(CategoryModel $category): void {}


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
//    public function updated(CategoryModel $category): void {}

}

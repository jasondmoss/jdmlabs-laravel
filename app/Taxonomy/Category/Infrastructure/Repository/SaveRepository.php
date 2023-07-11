<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Repository;

use App\Taxonomy\Category\Domain\Contract\SaveContract;
use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\CategoryFormRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class SaveRepository implements SaveContract
{

    protected Category $model;


    public function __construct()
    {
        $this->model = new Category;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\CategoryFormRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function save(CategoryFormRequest $data): Category
    {
        $category = isset($data->id)
            ? $this->model->find($data->id)
            : (new Category());

        try {
            $category->name = $data->name;

            $category->save();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $category;
    }

}

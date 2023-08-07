<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Policies;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class CategoryPolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->email === Config::get('jdmlabs.admin_email')) {
            return Response::allow();
        }

        return Response::deny('You are not have permission to create a new category.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user): Response
    {
        if ($user->email === Config::get('jdmlabs.admin_email')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this category.');
    }


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     * @param string $id
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(CategoryEloquentModel $category, string $id): Response
    {
        if ($category->id === $id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this category.');
    }

}

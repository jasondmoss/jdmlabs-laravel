<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Policies;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class CategoryPolicy
{

    use HandlesAuthorization;

    /**
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(): Response
    {
        return Response::allow();
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->can('categories-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new category.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, CategoryEloquentModel $category): Response
    {
        if ($user->can('categories-update')
            && $user->id === $category->user_id
        ) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this category.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserEloquentModel $user): Response
    {
        if ($user->can('categories-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this category.');
    }

}

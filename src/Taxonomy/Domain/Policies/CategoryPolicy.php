<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Policies;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\User\Domain\Models\UserModel;
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
     * @param \Aenginus\User\Domain\Models\UserModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserModel $user): Response
    {
        if ($user->can('categories-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new category.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserModel $user, CategoryModel $category): Response
    {
        /*if ($user->id === $category->user_id) {*/
        if ($user->can('categories-update')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this category.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserModel $user): Response
    {
        if ($user->can('categories-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this category.');
    }

}

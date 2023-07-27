<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain;

use App\Core\User\Infrastructure\User;
use App\Taxonomy\Infrastructure\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class CategoryPolicy
{

    use HandlesAuthorization;

    /**
     * @param \App\Core\User\Infrastructure\User $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(User $user): Response
    {
        return ($user->email === Config::get('jdmlabs.admin_email'))
            ? Response::allow()
            : Response::deny('You are not have permission to create a new category.');
    }


    /**
     * @param \App\Core\User\Infrastructure\User $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user): Response
    {
        return ($user->email === Config::get('jdmlabs.admin_email'))
            ? Response::allow()
            : Response::deny('You do not have permission to edit this category.');
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Category $category
     * @param string $id
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(Category $category, string $id): Response
    {
        return $category->id === $id
            ? Response::allow()
            : Response::deny('You do not have permission to view this category.');
    }

}

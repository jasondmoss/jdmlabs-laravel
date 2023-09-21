<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Policies;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class ArticlePolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Domain\Models\UserModel|null $user
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(UserModel|null $user, ArticleModel $article): Response
    {
        if ($article->status === Status::Published) {
            return Response::allow();
        }

        // Visitors cannot view unpublished items
        if ($user === null) {
            return Response::deny('You do not have permission to view this article.');
        }

        // Admin overrides published status
        if ($user->can('articles-view')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this article.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserModel $user): Response
    {
        if ($user->can('articles-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new article.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserModel $user, ArticleModel $article): Response
    {
        if ($user->can('articles-update') && $user->id === $article->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this article.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserModel $user): Response
    {
        if ($user->can('articles-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this article.');
    }

}

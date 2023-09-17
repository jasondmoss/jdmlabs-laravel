<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Policies;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class ArticlePolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel|null $user
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(UserEloquentModel|null $user, ArticleEloquentModel $article): Response
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
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->can('articles-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new article.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ArticleEloquentModel $article): Response
    {
        if ($user->can('articles-update') && $user->id === $article->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this article.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserEloquentModel $user): Response
    {
        if ($user->can('articles-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this article.');
    }

}

<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Policies;

use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ArticlePolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->email === Config::get('jdmlabs.admin_email')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new article.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(UserEloquentModel $user, ArticleEloquentModel $article): Response
    {
        if ($user->id === $article->user_id) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this article.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ArticleEloquentModel $article): Response
    {
        if ($user->id === $article->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this article.');
    }


    /**
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(ArticleEloquentModel $article): Response
    {
        if ($article->status === Status::Published) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this article.');
    }

}

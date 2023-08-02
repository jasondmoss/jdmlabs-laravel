<?php

declare(strict_types=1);

namespace App\Article\Domain\Policies;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use App\Shared\Enums\Status;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ArticlePolicy
{

    use HandlesAuthorization;

    /**
     * @param \App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        return ($user->email === Config::get('jdmlabs.admin_email'))
            ? Response::allow()
            : Response::deny('You are not authorized to create a new article.');
    }


    /**
     * @param \App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(UserEloquentModel $user, ArticleEloquentModel $article): Response
    {
        return $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this article.');
    }


    /**
     * @param \App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ArticleEloquentModel $article): Response
    {
        return $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to edit this article.');
    }


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(ArticleEloquentModel $article): Response
    {
        return Status::Published === $article->status
            ? Response::allow()
            : Response::deny('You do not have permission to view this article.');
    }

}

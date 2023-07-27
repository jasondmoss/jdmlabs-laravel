<?php

declare(strict_types=1);

namespace App\Article\Domain;

use App\Article\Infrastructure\Article;
use App\Core\Shared\Enums\Status;
use App\Core\User\Infrastructure\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ArticlePolicy
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
            : Response::deny('You are not authorized to create a new article.');
    }


    /**
     * @param \App\Core\User\Infrastructure\User $user
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(User $user, Article $article): Response
    {
        return $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this article.');
    }


    /**
     * @param \App\Core\User\Infrastructure\User $user
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Article $article): Response
    {
        return $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to edit this article.');
    }


    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(Article $article): Response
    {
        return Status::Published === $article->status
            ? Response::allow()
            : Response::deny('You do not have permission to view this article.');
    }

}

<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain;

use App\Auth\Infrastructure\User;
use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxonomyPolicy {

    use HandlesAuthorization;

    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Taxonomy\Infrastructure\Vocabulary $vocabulary
     *
     * @return true
     */
    public function view(User $user, Vocabulary $vocabulary)
    {
        return true;
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return isset($user);
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Taxonomy\Infrastructure\Vocabulary $vocabulary
     *
     * @return bool
     */
    public function update(User $user, Vocabulary $vocabulary)
    {
        return isset($user);
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Taxonomy\Infrastructure\Vocabulary $vocabulary
     *
     * @return bool
     */
    public function delete(User $user, Vocabulary $vocabulary)
    {
        return isset($user);
    }

}

<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain;

use App\Auth\Infrastructure\User;
use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxonomyPolicy {

    use HandlesAuthorization;

    public function view(User $user, Vocabulary $vocabulary)
    {
        return true;
    }

    public function create(User $user)
    {
        return isset($user);
    }

    public function update(User $user, Vocabulary $vocabulary)
    {
        return isset($user);
    }

    public function delete(User $user, Vocabulary $vocabulary)
    {
        return isset($user);
    }

}

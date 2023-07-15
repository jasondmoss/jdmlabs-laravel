<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

interface DeleteContract
{

    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void;

}

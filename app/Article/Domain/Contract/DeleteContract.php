<?php

declare(strict_types=1);

namespace App\Article\Domain\Contract;

interface DeleteContract
{

    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function delete(string $id): void;

}

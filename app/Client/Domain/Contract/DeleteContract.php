<?php

declare(strict_types=1);

namespace App\Client\Domain\Contract;

interface DeleteContract
{

    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void;
}

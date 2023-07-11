<?php

declare(strict_types=1);

namespace App\Project\Domain\Contract;

interface DeleteContract
{

    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void;

}

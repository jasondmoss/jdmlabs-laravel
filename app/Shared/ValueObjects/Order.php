<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

final readonly class Order
{

    private int $order;


    /**
     * @param int $order
     */
    public function __construct(int $order)
    {
        $this->order = $order;
    }


    /**
     * @return int
     */
    public function value(): int
    {
        return $this->order;
    }

}

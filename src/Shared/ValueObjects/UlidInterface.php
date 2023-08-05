<?php

declare(strict_types=1);

namespace Aenginus\Shared\ValueObjects;

interface UlidInterface
{

    /**
     * @return string
     */
    public function __toString(): string;


    /**
     * @return static
     */
    public static function random(): static;


    /**
     * @return string
     */
    public function value(): string;


    /**
     * @param \Aenginus\Shared\ValueObjects\UlidInterface $other
     *
     * @return bool
     */
    public function equals(self $other): bool;

}

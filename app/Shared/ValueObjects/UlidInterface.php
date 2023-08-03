<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

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
     * @param \App\Shared\ValueObjects\UlidInterface $other
     *
     * @return bool
     */
    public function equals(UlidInterface $other): bool;


    /**
     * @param string $value
     *
     * @return static
     */
    public static function fromPrimitives(string $value): static;

}

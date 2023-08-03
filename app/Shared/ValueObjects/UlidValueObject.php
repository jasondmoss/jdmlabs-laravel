<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use App\Shared\Exceptions\InvalidArgumentException;
use Stringable;
use Symfony\Component\Uid\Ulid;

class UlidValueObject implements Stringable
{

    private string $value;


    /**
     * @param string $value
     *
     * @throws \App\Shared\Exceptions\InvalidArgumentException
     */
    final public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }


    /**
     * @param string $value
     *
     * @return void
     * @throws \App\Shared\Exceptions\InvalidArgumentException
     */
    private function guard(string $value): void
    {
        if (false === Ulid::isValid($value)) {
            throw new InvalidArgumentException(sprintf('Value <%s> is not a valid ULID', $value));
        }
    }


    /**
     * @return static
     * @throws \App\Shared\Exceptions\InvalidArgumentException
     */
    public static function random(): static
    {
        return new static((new Ulid())->__toString());
    }


    /**
     * @param string $value
     *
     * @return static
     * @throws \App\Shared\Exceptions\InvalidArgumentException
     */
    public static function fromPrimitives(string $value): static
    {
        return new static($value);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


    /**
     * @param \App\Shared\ValueObjects\UlidInterface $other
     *
     * @return bool
     */
    public function equals(UlidInterface $other): bool
    {
        return $this->value() === $other->value();
    }

}

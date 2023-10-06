<?php

declare(strict_types=1);

namespace Aenginus\Shared\ValueObjects;

use Aenginus\Shared\Exceptions\InvalidArgumentException;
use Illuminate\Support\Str;
use Stringable;
use Symfony\Component\Uid\Ulid;

class UlidValueObject implements Stringable
{

    private string $value;


    /**
     * @param string $value
     *
     * @throws \Aenginus\Shared\Exceptions\InvalidArgumentException
     */
    final public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }


    /**
     * @param string $value
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\InvalidArgumentException
     */
    private function guard(string $value): void
    {
        if (Ulid::isValid($value) === false) {
            throw new InvalidArgumentException(
                sprintf('Value <%s> is not a valid ULID', $value)
            );
        }
    }


    /**
     * @return static
     * @throws \Aenginus\Shared\Exceptions\InvalidArgumentException
     */
    public static function random(): static
    {
        return new static((string)(new Ulid()));
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }


    /**
     * @param \Aenginus\Shared\ValueObjects\UlidInterface $other
     *
     * @return bool
     */
    final public function equals(UlidInterface $other): bool
    {
        return $this->value() === $other->value();
    }


    /**
     * @return string
     */
    final public function value(): string
    {
       // return Str::upper($this->value);
        return $this->value;
    }

}

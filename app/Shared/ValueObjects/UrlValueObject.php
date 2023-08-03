<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use InvalidArgumentException;

class UrlValueObject
{

    protected string $value;


    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (false === filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(sprintf('Invalid URL: %s', $value));
        }

        $this->value = $value;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }


    /**
     * @param string $value
     *
     * @return static
     */
    public static function fromString(string $value): static
    {
        return new UrlValueObject($value);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


    /**
     * @param UrlValueObject $otherString
     *
     * @return bool
     */
    public function equals(UrlValueObject $otherString): bool
    {
        return $this->value === $otherString->value;
    }


    /**
     * @return bool
     */
    public function empty(): bool
    {
        return empty($this->value());
    }

}

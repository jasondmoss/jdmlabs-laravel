<?php

declare(strict_types=1);

namespace Aenginus\Shared\ValueObjects;

use InvalidArgumentException;

class UrlValueObject
{
    private string $value;


    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException(sprintf('Invalid URL: %s', $value));
        }

        $this->value = $value;
    }


    /**
     * @param string $value
     *
     * @return static
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
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
    public function equals(self $otherString): bool
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

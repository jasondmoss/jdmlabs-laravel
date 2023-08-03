<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

class StringValueObject
{

    protected string $value;


    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
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
        return new StringValueObject($value);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


    /**
     * @param \App\Shared\ValueObjects\StringValueObject $otherString
     *
     * @return bool
     */
    public function equals(StringValueObject $otherString): bool
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

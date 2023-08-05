<?php

declare(strict_types=1);

namespace Aenginus\Shared\ValueObjects;

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
    public function __toString(): string
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
        return new self($value);
    }


    /**
     * @return string
     */
    final public function value(): string
    {
        return $this->value;
    }


    /**
     * @param \Aenginus\Shared\ValueObjects\StringValueObject $otherString
     *
     * @return bool
     */
    final public function equals(self $otherString): bool
    {
        return $this->value === $otherString->value;
    }


    /**
     * @return bool
     */
    final public function empty(): bool
    {
        return empty($this->value());
    }

}

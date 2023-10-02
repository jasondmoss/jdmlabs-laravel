<?php

declare(strict_types=1);

namespace Aenginus\Shared\ValueObjects;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use ReflectionClass;
use Stringable;

/**
 * @see https://github.com/CodelyTV/php-ddd-example/blob/main/src/Shared/Domain/ValueObject/Enum.php
 */
abstract class EnumValueObject implements Stringable
{

    private static array $cache;


    /**
     * @param mixed $value
     *
     * @throws \ReflectionException
     */
    public function __construct(protected mixed $value)
    {
        $this->ensureIsBetweenAcceptedValues($value);
    }


    /**
     * @param mixed $value
     *
     * @return void
     * @throws \ReflectionException
     */
    private function ensureIsBetweenAcceptedValues(mixed $value): void
    {
        if (! in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }


    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function values(): array
    {
        $class = static::class;

        if (! isset(self::$cache[$class])) {
            $reflected = new ReflectionClass($class);

            self::$cache[$class] = reindex(
                self::keysFormatter(),
                $reflected->getConstants()
            );
        }

        return self::$cache[$class];
    }


    /**
     * @return callable
     */
    private static function keysFormatter(): callable
    {
        return static fn($unused, string $key): string => Str::camel(strtolower($key));
    }


    /**
     * @param mixed $value
     *
     * @return mixed
     */
    abstract public function throwExceptionForInvalidValue(mixed $value): mixed;


    /**
     * @param string $name
     * @param array $args
     *
     * @return static
     * @throws \ReflectionException
     */
    public static function __callStatic(string $name, array $args): self
    {
        return new static(self::values()[$name]);
    }


    /**
     * @param string $value
     *
     * @return \Aenginus\Shared\ValueObjects\EnumValueObject
     * @throws \ReflectionException
     */
    public static function fromString(string $value): self
    {
        return new static($value);
    }


    /**
     * @return static
     * @throws \ReflectionException
     */
    public static function random(): static
    {
        return new static(self::randomValue());
    }


    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public static function randomValue(): mixed
    {
        return self::values()[array_rand(self::values())];
    }


    /**
     * @param \Illuminate\Validation\Rules\Enum $other
     *
     * @return bool
     */
    final public function equals(Enum $other): bool
    {
        return $other === $this;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value();
    }


    /**
     * @return mixed
     */
    final public function value(): mixed
    {
        return $this->value;
    }

}


/**
 * Returns a new collection with the keys reindexed by `$fn`.
 * Optionally `$fn` receive the key as the second argument.
 *
 * @param callable $fn function to generate the key
 * @param iterable $coll collection to be reindexed
 *
 * @return array
 * @see https://github.com/Lambdish/phunctional/blob/3f17d1ee6072c63afa12ad5127d4b0662a9d8cee/src/reindex.php
 * @since 0.1
 *
 */
function reindex(callable $fn, iterable $coll): array
{
    $result = [];

    foreach ($coll as $key => $value) {
        $result[$fn($value, $key)] = $value;
    }

    return $result;
}

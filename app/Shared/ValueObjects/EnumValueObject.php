<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

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
     * @param $value
     *
     * @throws \ReflectionException
     */
    public function __construct(protected $value)
    {
        $this->ensureIsBetweenAcceptedValues($value);
    }


    /**
     * @param $value
     *
     * @return mixed
     */
    protected abstract function throwExceptionForInvalidValue($value): mixed;


    /**
     * @param string $name
     * @param $args
     *
     * @return static
     * @throws \ReflectionException
     */
    public static function __callStatic(string $name, $args)
    {
        return new static(self::values()[ $name ]);
    }


    /**
     * @param string $value
     *
     * @return \App\Shared\ValueObjects\EnumValueObject
     * @throws \ReflectionException
     */
    public static function fromString(string $value): EnumValueObject
    {
        return new static($value);
    }


    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function values(): array
    {
        $class = static::class;

        if (! isset(self::$cache[ $class ])) {
            $reflected = new ReflectionClass($class);

            self::$cache[ $class ] = reindex(
                self::keysFormatter(),
                $reflected->getConstants()
            );
        }

        return self::$cache[ $class ];
    }


    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public static function randomValue(): mixed
    {
        return self::values()[ array_rand(self::values()) ];
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
     * @return callable
     */
    private static function keysFormatter(): callable
    {
        /*return static fn ($unused, string $key): string => Utils::toCamelCase(strtolower($key));*/
        return static fn ($unused, string $key): string => Str::camel(strtolower($key));
    }


    /**
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
    }


    /**
     * @param \Illuminate\Validation\Rules\Enum $other
     *
     * @return bool
     */
    public function equals(Enum $other): bool
    {
        return $other == $this;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value();
    }


    /**
     * @param $value
     *
     * @return void
     * @throws \ReflectionException
     */
    private function ensureIsBetweenAcceptedValues($value): void
    {
        if (! in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
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
 * @since 0.1
 *
 * @see https://github.com/Lambdish/phunctional/blob/3f17d1ee6072c63afa12ad5127d4b0662a9d8cee/src/reindex.php
 */
function reindex(callable $fn, iterable $coll): array
{
    $result = [];

    foreach ($coll as $key => $value) {
        $result[ $fn($value, $key) ] = $value;
    }

    return $result;
}

<?php

declare(strict_types=1);

namespace Aenginus\Shared\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

final readonly class ConvertNullToEmptyString implements CastsInboundAttributes
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return string
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if ($value === null) {
            return '';
        }

        if (is_string($value)) {
            return $value;
        }

        throw new InvalidArgumentException('You must provide null or a string.');
    }
}

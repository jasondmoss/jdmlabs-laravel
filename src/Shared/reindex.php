<?php

declare(strict_types=1);

namespace Aenginus\Shared;

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
        $result[ $fn($value, $key) ] = $value;
    }

    return $result;
}

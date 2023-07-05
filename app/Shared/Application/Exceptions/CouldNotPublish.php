<?php

declare(strict_types=1);

namespace App\Shared\Application\Exceptions;

use Exception;

final class CouldNotPublish extends Exception {

    /**
     * @return self
     */
    public static function becauseAlreadyPublished(): self
    {
        return new self('ArticleModel may not be published more than once.');
    }


    /**
     * @return self
     */
    public static function becauseBodyIsMissing(): self
    {
        return new self('ArticleModel body must not be empty.');
    }


    /**
     * @return self
     */
    /*public static function becauseTagsAreMissing(): self
    {
        return new self('ArticleModel must have at least one tag.');
    }*/


    /**
     * @return self
     */
    public static function becauseSummaryIsMissing(): self
    {
        return new self('ArticleModel summary must not be empty.');
    }

}

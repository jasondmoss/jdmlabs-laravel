<?php

declare(strict_types=1);

namespace App\Article\Application\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class CouldNotDeleteArticle extends Exception implements HttpExceptionInterface
{

    /**
     * @param string $id
     *
     * @return self
     */
    public static function withId(string $id): self
    {
        return new self("Could not delete article with ID, '{$id}'.");
    }


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return Response::HTTP_EXPECTATION_FAILED;
    }


    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [];
    }

}

<?php

declare(strict_types=1);

namespace App\Shared\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class CouldNotFindCategory
    extends Exception
    implements HttpExceptionInterface
{

    /**
     * @param string $slug
     *
     * @return self
     */
    public static function withSlug(string $slug): self
    {
        return new self("Could not find category, '{$slug}'.");
    }


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }


    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [];
    }

}

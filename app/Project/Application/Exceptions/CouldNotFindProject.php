<?php

declare(strict_types=1);

namespace App\Project\Application\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class CouldNotFindProject extends Exception implements HttpExceptionInterface
{

    /**
     * @param string $id
     *
     * @return self
     */
    public static function withId(string $id): self
    {
        return new self("Could not find project with ID, '{$id}'.");
    }


    /**
     * @param string $slug
     *
     * @return self
     */
    public static function withSlug(string $slug): self
    {
        return new self("Could not find project by slug, '{$slug}'.");
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

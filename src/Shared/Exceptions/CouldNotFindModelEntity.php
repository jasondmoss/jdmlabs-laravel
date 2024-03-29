<?php

declare(strict_types=1);

namespace Aenginus\Shared\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class CouldNotFindModelEntity extends Exception implements HttpExceptionInterface
{
    /**
     * @param string $id
     *
     * @return self
     */
    public static function withId(string $id): self
    {
        return new self("Could not find entity with ID, '{$id}'.");
    }


    /**
     * @param string $slug
     *
     * @return self
     */
    public static function withSlug(string $slug): self
    {
        return new self("Could not find entity by slug, '{$slug}'.");
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

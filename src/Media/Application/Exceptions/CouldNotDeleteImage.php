<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class CouldNotDeleteImage
    extends Exception
    implements HttpExceptionInterface
{

    /**
     * @param string $id
     *
     * @return self
     */
    public static function withId(string $id): self
    {
        return new self("Could not delete image with ID, '{$id}'.");
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
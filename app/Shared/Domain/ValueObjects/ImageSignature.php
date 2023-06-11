<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

readonly final class ImageSignature {

    private array $signature;


    /**
     * @param array $signature
     */
    public function __construct(array $signature)
    {
        $this->signature = $signature;
    }


    /**
     * @return array
     */
    public function value(): array
    {
        return $this->signature;
    }

}

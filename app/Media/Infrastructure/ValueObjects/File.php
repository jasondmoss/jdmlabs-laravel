<?php

declare(strict_types=1);

namespace App\Media\Infrastructure\ValueObjects;

use Illuminate\Http\UploadedFile;

final readonly class File
{

    private UploadedFile $image;


    /**
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function __construct(UploadedFile $image)
    {
        $this->image = $image;
    }


    /**
     * @return UploadedFile
     */
    public function value(): UploadedFile
    {
        return $this->image;
    }

}

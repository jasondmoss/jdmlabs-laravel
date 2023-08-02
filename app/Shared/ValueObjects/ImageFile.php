<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use Illuminate\Http\UploadedFile;

final readonly class ImageFile
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
//        dd($this->image);

        return $this->image;
    }

}

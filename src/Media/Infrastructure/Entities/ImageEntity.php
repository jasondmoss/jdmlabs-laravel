<?php

declare(strict_types=1);

namespace Aenginus\Media\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UploadedFileValueObject;
use Illuminate\Http\UploadedFile;

final readonly class ImageEntity
{

    public UploadedFile $file;
    public int $width;
    public int $height;
    public string|null $alt;
    public string|null $caption;
    public string|null $label;


    /**
     * @param object $image
     */
    public function __construct(object $image)
    {
        if (! empty($image->file)) {
            $this->file = (new UploadedFileValueObject($image->file))->value();

            [ $this->width, $this->height ] = getimagesize(
                $this->file->getRealPath()
            );
        }
        $this->alt = ! empty($image->alt)
            ? (new StringValueObject($image->alt))->value()
            : 'A placeholder image description';
        $this->caption = ! empty($image->caption)
            ? (new StringValueObject($image->caption))->value()
            : null;
        $this->label = ! empty($image->label)
            ? (new StringValueObject($image->label))->value()
            : null;
    }

}

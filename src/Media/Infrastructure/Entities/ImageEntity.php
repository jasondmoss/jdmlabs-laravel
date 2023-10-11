<?php

declare(strict_types=1);

namespace Aenginus\Media\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UploadedFileValueObject;
use Illuminate\Http\UploadedFile;

class ImageEntity
{

    public string $type;

    public ?string $label;

    public ?string $alt;

    public ?string $caption;

    public ?UploadedFile $file;

    public ?int $width;

    public ?int $height;


    /**
     * @param object $image
     */
    public function __construct(object $image)
    {
        $this->type = (new StringValueObject($image->type))->value();

        $this->label = ! empty($image->label)
            ? (new StringValueObject($image->label))->value()
            : null;

        $this->alt = ! empty($image->alt)
            ? (new StringValueObject($image->alt))->value()
            : 'A placeholder image description';

        $this->caption = ! empty($image->caption)
            ? (new StringValueObject($image->caption))->value()
            : null;

        if (! empty($image->file)) {
            $this->file = (new UploadedFileValueObject($image->file))->value();

            [ $this->width, $this->height ] = getimagesize(
                $this->file->getRealPath()
            );
        }
    }

}

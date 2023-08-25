<?php

declare(strict_types=1);

namespace Aenginus\Media\Infrastructure\Entities;

use Aenginus\Media\Infrastructure\ValueObjects\Alt;
use Aenginus\Media\Infrastructure\ValueObjects\Caption;
use Aenginus\Media\Infrastructure\ValueObjects\File;
use Aenginus\Media\Infrastructure\ValueObjects\Label;
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
            $this->file = (new File($image->file))->value();

            [ $this->width, $this->height ] = getimagesize(
                $this->file->getRealPath()
            );
        }

        $this->alt = ! empty($image->alt)
            ? (new Alt($image->alt))->value()
            : 'A placeholder image description';

        $this->caption = ! empty($image->caption)
            ? (new Caption($image->caption))->value()
            : null;

        $this->label = ! empty($image->label)
            ? (new Label($image->label))->value()
            : null;
    }

}

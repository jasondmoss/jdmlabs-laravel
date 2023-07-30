<?php

declare(strict_types=1);

namespace App\Media\Infrastructure\Entities;

use App\Core\Shared\ValueObjects\ImageAlt;
use App\Core\Shared\ValueObjects\ImageCaption;
use App\Core\Shared\ValueObjects\ImageFile;
use App\Core\Shared\ValueObjects\ImageLabel;
use Illuminate\Http\UploadedFile;

final readonly class ImageEntity
{

    public ?UploadedFile $file;

    public ?int $width;

    public ?int $height;

    public ?string $alt;

    public ?string $caption;

    public ?string $label;


    /**
     * @param ?object $image
     */
    public function __construct(?object $image)
    {
        $this->file = isset($image->file)
            ? (new ImageFile($image->file))->value()
            : null;

        if (! is_null($this->file)) {
            [ $this->width, $this->height ] = getimagesize($this->file->getRealPath());
        }

        $this->alt = ! empty($image->alt)
            ? (new ImageAlt($image->alt))->value()
            : null;

        $this->caption = ! empty($image->caption)
            ? (new ImageCaption($image->caption))->value()
            : null;

        $this->label = ! empty($image->label)
            ? (new ImageLabel($image->label))->value()
            : null;
    }

}

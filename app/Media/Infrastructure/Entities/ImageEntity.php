<?php

declare(strict_types=1);

namespace App\Media\Infrastructure\Entities;

use App\Media\Infrastructure\ValueObjects\Alt;
use App\Media\Infrastructure\ValueObjects\Caption;
use App\Media\Infrastructure\ValueObjects\File;
use App\Media\Infrastructure\ValueObjects\Label;
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
     * @param object|null $image
     */
    public function __construct(?object $image)
    {
        $this->file = isset($image->file)
            ? (new File($image->file))->value()
            : null;

        if (! is_null($this->file)) {
            [ $this->width, $this->height ] = getimagesize($this->file->getRealPath());
        }

        $this->alt = ! empty($image->alt)
            ? (new Alt($image->alt))->value()
            : null;

        $this->caption = ! empty($image->caption)
            ? (new Caption($image->caption))->value()
            : null;

        $this->label = ! empty($image->label)
            ? (new Label($image->label))->value()
            : null;
    }

}

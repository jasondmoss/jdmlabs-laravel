<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

use Illuminate\Database\Eloquent\Model;

trait MediaExtended
{

    /**
     * @param string $path
     *
     * @return string
     */
    private function imageElement(string $path): string
    {
        return '<img src="' . asset($path) . '" alt="'
            . __('Placeholder image') . '">';
    }


    /**
     * @param string $context
     *
     * @return string
     */
    private function defaultPlaceholderImage(string $context): string
    {
        return $this->imageElement('images/placeholder/' . $context . '.png');
    }


    public function getSignatureImage()
    {
        if (! $this->image) {
            return $this->defaultPlaceholderImage('signature');
        }

        $filePath = asset($this->image->filepath . $this->image->filename);
        $fileAlt = __($this->image->alt);

        return <<<IMG
<img src="{$filePath}"
  width="{$this->image->width}"
  height="{$this->image->height}"
  alt="{$fileAlt}"
>
IMG;
    }

}

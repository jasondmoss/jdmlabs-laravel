<?php

declare(strict_types=1);

namespace App\Media\Domain\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface AttachContract
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param \Illuminate\Foundation\Http\FormRequest|null $data
     * @param string $collection
     */
    public function attach(?Model $model, ?FormRequest $data, string $collection = '');

}

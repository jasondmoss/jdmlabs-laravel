<?php

declare(strict_types=1);

namespace App\Core\Shared\Traits;

use Illuminate\Database\Eloquent\Model;

trait Observable
{

    /**
     * @return void
     */
    public static function bootObservable(): void
    {
        static::updating(function (Model $model) {
            // dd('updating');
        });
    }

}

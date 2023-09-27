<?php

declare(strict_types=1);

namespace App;

use Illuminate\Foundation\Exceptions\Handler;
use Throwable;

class ExceptionHandler extends Handler
{

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(static function (Throwable $e) {});
    }

}

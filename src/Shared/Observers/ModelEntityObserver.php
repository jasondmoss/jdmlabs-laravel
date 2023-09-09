<?php

declare(strict_types=1);

namespace Aenginus\Shared\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

final readonly class ModelEntityObserver
{

    public function creating(Model $model): void
    {
        if (! App::runningInConsole()) {
            $model->user_id = auth()->user()->id;
        }
    }


    public function created(Model $model): void {}


    public function deleting(Model $model): void {}


    public function deleted(Model $model): void {}


    public function updating(Model $model): void {}


    public function updated(Model $model): void {}

}

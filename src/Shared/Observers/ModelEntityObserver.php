<?php

declare(strict_types=1);

namespace Aenginus\Shared\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

final readonly class ModelEntityObserver
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function creating(Model $model): void
    {
        if (! App::runningInConsole()) {
            $model->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function created(Model $model): void {}


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function deleting(Model $model): void {}


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function deleted(Model $model): void {}


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function updating(Model $model): void {}


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function updated(Model $model): void {}
}

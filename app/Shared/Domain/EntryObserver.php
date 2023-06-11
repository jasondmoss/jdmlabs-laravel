<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

final readonly class EntryObserver {

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

        $model->slug = Str::of($model->title)->slug('-');
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
    public function updating(Model $model): void
    {
        $model->slug = Str::of($model->title)->slug('-');
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function updated(Model $model): void {}

}

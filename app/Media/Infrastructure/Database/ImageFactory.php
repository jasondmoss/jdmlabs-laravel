<?php

declare(strict_types=1);

namespace App\Media\Infrastructure\Database;

use App\Core\Shared\Enums\Status;
use App\Media\Infrastructure\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{

    protected $model = Image::class;


    public function definition(): array
    {
        //
    }


//    public function hasBody(): self
//    {
//        return $this->state([
//            'body' => $this->faker->text(300)
//        ]);
//    }


//    public function hasSummary(): self
//    {
//        return $this->state([
//            'summary' => $this->faker->text(100)
//        ]);
//    }


    public function publishable(): self
    {
        return $this->hasTags(1)->hasBody()->hasSummary();
    }


    public function published(): self
    {
        return $this->publishable()->state([
            'published_at' => '1970-01-01 00:00:00',
            'state' => Status::Published
        ]);
    }

}

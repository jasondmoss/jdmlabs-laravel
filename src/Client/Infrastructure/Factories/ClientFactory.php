<?php

declare(strict_types=1);

namespace Aenginus\Client\Infrastructure\Factories;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\User\Domain\Models\UserModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class ClientFactory extends Factory
{

    protected $model = ClientModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $name = Str::title($faker->words(7, true));
        $slug = Str::of($name)->slug('-');
        $created = Date::today()->subDays(random_int(0, 365));

        return [
            'id' => Str::ulid(),
            'name' => $name,
            'slug' => $slug,
            'itemprop' => ucfirst($faker->word()),
            'website' => 'https://' . $faker->domainName() . '/',
            'summary' => $faker->text(170),
            'status' => 'published',
            'promoted' => 'not_promoted',
            'user_id' => UserModel::whereEmail('jason@jdmlabs.com')
                ->first()
                ->id,
            'published_at' => $created,
            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }

}

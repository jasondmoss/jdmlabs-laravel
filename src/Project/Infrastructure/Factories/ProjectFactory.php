<?php

declare(strict_types=1);

namespace Aenginus\Project\Infrastructure\Factories;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\User\Domain\Models\UserModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class ProjectFactory extends Factory
{

    protected $model = ProjectModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $title = Str::title($faker->sentence(4));
        $created = Date::today()->subDays(random_int(0, 365));

        return [
            'id' => (string) Str::ulid(),
            'title' => $title,
            'subtitle' => $faker->sentence(),
            'website' => 'https://' . $faker->domainName() . '/',
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(2, true),
            'status' => 'published',
            'promoted' => 'not_promoted',
            'pinned' => 'not_pinned',
            'client_id' => ClientModel::inRandomOrder()->first(),
            'user_id' => UserModel::whereEmail('jason@jdmlabs.com')->first()->id,
            'published_at' => $created,
            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }

}

<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TaxonomySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedVocabularies([

            // Articles
            [
                'vocabulary' => 'article_categories',
                'terms' => [
                    [
                        'name' => 'Web Development',
                        'description' => 'General web development topics.',
                        'terms' => [
                            'CSS',
                            'Craft CMS',
                            'Drupal',
                            'HTML',
                            'JavaScript',
                            'Laravel',
                            'Shopify',
                            'Symfony',
                            'WordPress'
                        ]
                    ],
                    [
                        'name' => 'Operating Systems',
                        'description' => 'General operating system topics.',
                        'terms' => [
                            'Linux',
                            'Fedora',
                            'NixOS',
                            'Ubuntu'
                        ]
                    ],
                    [
                        'name' => 'Cooking'
                    ],
                    [
                        'name' => 'Mountain Biking'
                    ],
                    [
                        'name' => 'Photography'
                    ],
                    [
                        'name' => 'Reading'
                    ]
                ]
            ],

            // Projects
            [
                'vocabulary' => 'project_categories',
                'terms' => [
                    [
                        'name' => 'Technology',
                        'description' => 'Project technology stacks.',
                        'terms' => [
                            'Craft CMS',
                            'Drupal',
                            'Laravel',
                            'Shopify',
                            'WordPress'
                        ]
                    ]
                ]
            ],

            // TAGS
            [
                'vocabulary' => 'tags',
                'description' => 'Generic, reusable tags for filtering and sorting.',
                'terms' => [
                    'calgary',
                    'development',
                    'general',
                    'halifax',
                    'linux',
                    'news',
                    'os',
                    'ottawa',
                    'places',
                    'yellowknife'
               ]
            ]

        ]);
    }


    /**
     * @param array $vocabularies
     */
    protected function seedVocabularies(array $vocabularies): void
    {
        foreach ($vocabularies as $item) {
            if (! empty($item['terms'])) {
                $this->seedTerms($item['terms'], $item['vocabulary']);
            }
        }
    }


    /**
     * @param array $terms
     * @param string $vocabulary
     * @param null $parentId
     */
    protected function seedTerms(array $terms, string $vocabulary, $parentId = null): void
    {
        $termModelClass = Term::class;

        foreach ($terms as $item) {
            if (is_array($item)) {
                $term = $termModelClass::updateOrCreate([
                    'name' => $item['name'],
                    'vocabulary' => Arr::get($item, 'vocabulary', $vocabulary),
                ], [
                    'slug' => isset($item['slug'])
                        ? Str::slug($item['slug'], '-')
                        : Str::slug($item['name'], '-'),
                    'description' => Arr::get($item, 'description'),
                    'parent_id' => $parentId,
                ]);
            } else {
                $term = $termModelClass::updateOrCreate([
                    'name' => $item,
                    'vocabulary' => $vocabulary,
                ], [
                    'slug' => Str::slug($item),
                    'parent_id' => $parentId,
                ]);
            }

            $this->command->info(
                " - Term saved: {$term->id}: $term->name [{$term->vocabulary}]"
            );

            if (! empty($item['terms'])) {
                $this->seedTerms($item['terms'], $vocabulary, $term->id);
            }
        }
    }

}

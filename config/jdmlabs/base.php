<?php

declare(strict_types=1);

return [
    'title' => env('APP_NAME', 'JdmLabs'),
    'title_home' => 'JdmLabs, Artisan Web Developer',
    'description' => env('JDMLABS_DESC', 'The Online Laboratory of Jason D. Moss'),
    'image_share' => env('APP_IMAGE', 'mugshot--525.jpg'),
    'slug_locale' => 'en',
    'contact_email' => 'work@jdmlabs.com',

    'images' => [
        'defaults' => [
            'thumb' => [ null, 100, 100 ],
            'preview' => [ null, 300, 300 ],
        ],

        'responsive' => [
            'mobile' => [ 480, 640, 500 ],
            'mobilelg' => [ 640, 760, 500 ],
            'tablet' => [ 760, 1024, 800 ],
            'desktop' => [ 1024, 1200, 800 ],
            'desktop_lg' => [ 1200, 1500, 1000 ]
        ]
    ]
];

<?php

declare(strict_types=1);

return [

    'title' => env('APP_NAME', 'JdmLabs'),
    'title_home' => 'JdmLabs, Artisan Web Developer',
    'description' => env('JDMLABS_DESC', 'The Online Laboratory of Jason D. Moss'),
    'image_share' => env('APP_IMAGE', 'mugshot--525.jpg'),
    'slug_locale' => 'en',

    'admin_email' => env('APP_EMAIL', 'jason@jdmlabs.com'),
    'admin_password' => env('APP_PASSWORD', 'not_a_real_password'),
    'contact_email' => 'work@jdmlabs.com',

    'permissions' => [
        'roles' => [
            'administrator' => [
                'display_name' => 'Administrator',
                'description' => "This is the 'God' role.",
                'allowed' => [
                    'articles' => 'c,d,f,p,s,u,v',
                    'categories' => 'c,d,f,p,s,u,v',
                    'clients' => 'c,d,f,p,s,u,v',
                    'media' => 'c,d,f,p,s,u,v',
                    'projects' => 'c,d,f,p,s,u,v'
                ]
            ],

            'guest' => [
                'display_name' => 'Guest',
                'description' => 'The default account for all non-active users.',
                'allowed' => [
                    'articles' => 'v',
                    'categories' => 'v',
                    'clients' => 'v',
                    'media' => 'v',
                    'projects' => 'v'
                ]
            ]
        ],

        'map' => [
            'c' => 'create',
            'd' => 'delete',
            'f' => 'promote',
            'p' => 'publish',
            's' => 'pin',
            'u' => 'update',
            'v' => 'view'
        ]
    ]

];

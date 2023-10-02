<?php

declare(strict_types=1);

return [
    'admin_email' => env('APP_EMAIL', 'jason@jdmlabs.com'),
    'admin_password' => env('APP_PASSWORD', 'not_a_real_password'),

    'permissions' => [
        'map' => [
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete',
            'pu' => 'publish',
            'pr' => 'promote',
            'pi' => 'pin'
        ],

        'roles' => [
            'administrator' => [
                'display_name' => 'Administrator',
                'description' => "This is the 'God' role.",
                'allowed' => [
                    'image'      => 'c,r,u,d',
                    'categories' => 'c,r,u,d',
                    'articles'   => 'c,r,u,d,pu,pr',
                    'clients'    => 'c,r,u,d,pu,pr',
                    'projects'   => 'c,r,u,d,pu,pr,pi'
                ]
            ],

            'guest' => [
                'display_name' => 'Guest',
                'description' => 'The default account for all non-active users.',
                'allowed' => [
                    'articles'   => 'r',
                    'categories' => 'r',
                    'clients'    => 'r',
                    'image'      => 'r',
                    'projects'   => 'r'
                ]
            ]
        ]
    ]
];

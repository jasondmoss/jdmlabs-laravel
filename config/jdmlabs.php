<?php

declare(strict_types=1);

use Spatie\Permission\Models\Permission;

return [

    'title' => env('APP_NAME', 'JdmLabs'),
    'title_home' => 'JdmLabs, Artisan Web Developer',
    'description' => env('JDMLABS_DESC', 'The Online Laboratory of Jason D. Moss'),
    'image_share' => env('APP_IMAGE', 'mugshot--525.jpg'),
    'slug_locale' => 'en',

    'admin_email' => env('APP_EMAIL', 'jason@jdmlabs.com'),
    'admin_password' => env('APP_PASSWORD', 'not_a_real_password'),
    'contact_email' => 'work@jdmlabs.com',

    'auth' => [
        'permissions' => [
            'article' => [
                'create article',
                'delete article',
                'edit article',
                'promote article',
                'publish article',
                'view article'
            ],
            'client' => [
                'create client',
                'delete client',
                'edit client',
                'promote client',
                'publish client',
                'view client'
            ],
            'project' => [
                'create project',
                'delete project',
                'edit project',
                'pin project',
                'promote project',
                'publish project',
                'view project'
            ],
            'media' => [
                'create media',
                'delete media',
                'edit media',
                'view media'
            ],
            'category' => [
                'create category',
                'delete category',
                'edit category',
                'view category'
            ]
        ],

        'roles' => [ 'god' ]
    ]

];

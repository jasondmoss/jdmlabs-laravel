<?php

declare(strict_types=1);

use Aenginus\Article\Application\Providers as Article;
use Aenginus\Client\Application\Providers as Client;
use Aenginus\Media\Application\Providers as Media;
use Aenginus\Project\Application\Providers as Project;
use Aenginus\Taxonomy\Application\Providers as Taxonomy;
use Aenginus\User\Application\Providers as Fortify;
use App\Providers as App;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Cache\CacheServiceProvider;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;
use Illuminate\Foundation\Providers\FoundationServiceProvider;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pipeline\PipelineServiceProvider;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\View\ViewServiceProvider;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageServiceProvider;
use Spatie\Html\Facades\Html;

return [

    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'asset_url' => env('ASSET_URL'),
    'timezone' => 'UTC',
    'locale' => 'en_CA',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_CA',
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
    'maintenance' => [
        'driver' => 'file'
    ],
    'providers' => [

        /** -- Laravel Core Service Providers. */

        AuthServiceProvider::class,
        BroadcastServiceProvider::class,
        BusServiceProvider::class,
        CacheServiceProvider::class,
        ConsoleSupportServiceProvider::class,
        CookieServiceProvider::class,
        DatabaseServiceProvider::class,
        EncryptionServiceProvider::class,
        FilesystemServiceProvider::class,
        FoundationServiceProvider::class,
        HashServiceProvider::class,
        MailServiceProvider::class,
        NotificationServiceProvider::class,
        PaginationServiceProvider::class,
        PipelineServiceProvider::class,
        QueueServiceProvider::class,
        RedisServiceProvider::class,
        PasswordResetServiceProvider::class,
        SessionServiceProvider::class,
        TranslationServiceProvider::class,
        ValidationServiceProvider::class,
        ViewServiceProvider::class,

        /** -- Package Service Providers. */

        Fortify\FortifyServiceProvider::class,
        ImageServiceProvider::class,

        /** -- Application Service Providers. */

        App\AppServiceProvider::class,
        App\AuthServiceProvider::class,
        App\BroadcastServiceProvider::class,
        App\EventServiceProvider::class,
        App\FolioServiceProvider::class,
        App\RouteServiceProvider::class,

        /** -- Custom Service Providers. */

        Article\ArticleAuthServiceProvider::class,
        Article\ArticleEventServiceProvider::class,
        Article\ArticleServiceProvider::class,

        Client\ClientAuthServiceProvider::class,
        Client\ClientEventServiceProvider::class,
        Client\ClientServiceProvider::class,

        Media\MediaServiceProvider::class,

        Project\ProjectAuthServiceProvider::class,
        Project\ProjectEventServiceProvider::class,
        Project\ProjectServiceProvider::class,

        Taxonomy\CategoryAuthServiceProvider::class,
        Taxonomy\CategoryEventServiceProvider::class,
        Taxonomy\CategoryServiceProvider::class

    ],

    'aliases' => Facade::defaultAliases()->merge([
        'Debugbar' => Debugbar::class,
        'Html' => Html::class,
        'Image' => Image::class
    ])->toArray()

];

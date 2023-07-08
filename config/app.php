<?php

declare(strict_types=1);

use App\Article\ArticleServiceProvider;
use App\Auth\FortifyServiceProvider;
use App\Client\ClientServiceProvider;
use App\Laravel\Application\Providers\AppServiceProvider;
use App\Laravel\Application\Providers\AuthServiceProvider as AppAuthServiceProvider;
use App\Laravel\Application\Providers\BroadcastServiceProvider as AppBroadcastServiceProvider;
use App\Laravel\Application\Providers\EventServiceProvider;
use App\Laravel\Application\Providers\RouteServiceProvider;
use App\Project\ProjectServiceProvider;
use App\Shared\GlobalAuthServiceProvider;
use App\Shared\GlobalServiceProvider;
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
use Intervention\Image\ImageServiceProvider as InterventionImageServiceProvider;
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

        /** -- Laravel Framework Service Providers. */

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

        FortifyServiceProvider::class,
        InterventionImageServiceProvider::class,

        /** -- Application Service Providers. */

        GlobalServiceProvider::class,
        GlobalAuthServiceProvider::class,

        AppServiceProvider::class,
        AppAuthServiceProvider::class,
        AppBroadcastServiceProvider::class,
        EventServiceProvider::class,
        RouteServiceProvider::class,

        ArticleServiceProvider::class,
        ClientServiceProvider::class,
        ProjectServiceProvider::class

    ],

    'aliases' => Facade::defaultAliases()->merge([
        'Debugbar' => Debugbar::class,
        'Html' => Html::class,
        'Image' => Image::class
    ])->toArray()

];

@php
use Aenginus\Article\Interface\Web\Controllers as Article;
use Aenginus\Project\Interface\Web\Controllers as Project;
use Aenginus\Client\Interface\Web\Controllers as Client;
use Aenginus\Taxonomy\Interface\Web\Controllers as Taxonomy;
@endphp
<!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8">
<!--
 * @author    Jason D. Moss <work@jdmlabs.com>
 * @copyright 2005-2023 Jason D. Moss. All rights freely given.
 * @license   https://www.jdmlabs.com/LICENSE.md [MIT License]
 *
 * @link {Profile} https://behance.net/jasondmoss
 * @link {Profile} https://github.com/jasondmoss
 * @link {Profile} https://twitter.com/jasondmoss
 * @link {Profile} https://about.me/jasondmoss
 * @link {Profile} https://www.linkedin.com/in/jasondmoss
 * @link {Profile} https://www.last.fm/user/jasonmoss
-->
<title>{{ $title }} &#160;&#11825;&#160; {{ config('jdmlabs.title', 'JdmLabs') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="color-scheme" content="dark light">
<meta name="canonical" content="{{ config('app.url') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="title" content="@if ($title) {{ $title }} &#160;&#11825;&#160; @endif {{ config('jdmlabs.title', 'JdmLabs') }}">
<meta name="description" content="{{ config('jdmlabs.description') }}">
<link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/bmono--400.woff2') }}" as="font" crossorigin>
<link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/bmono--700.woff2') }}" as="font" crossorigin>
<style>
@font-face {
  font-family: "Berkeley Mono";
  font-style: normal;
  font-weight: normal;
  font-display: swap;
  src: url("{{ Vite::asset('resources/assets/fonts/bmono--400.woff2') }}") format("woff2");
}
@font-face {
  font-family: "Berkeley Mono Bold";
  font-style: normal;
  font-weight: bold;
  font-display: swap;
  src: url("{{ Vite::asset('resources/assets/fonts/bmono--700.woff2') }}") format("woff2");
}
</style>

<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://unpkg.com">
<link rel="dns-prefetch" href="https://unpkg.com">

@stack('vendor-styles')
@vite('resources/assets/css/aenginus.css')

</head><body class="admin {{ $page }}{{ Auth::check() ? ' logged-in' : '' }} container mx-auto cursor-default">

<header class="flex flex-wrap justify-between pb-0 pt-0 pr-4 border-solid border-b-2 border-slate-200 sm:bg-red-200 md:bg-lime-200 lg:pb-0 lg:bg-sky-200 xl:bg-yellow-200">
  <nav class="flex justify-center">
    <a itemprop="url" rel="index" class="group p-4 lg:p-6 max-w-sm flex align-middle items-center space-x-4" href="{{ config('app.url') }}" title="@yield('title')">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 569.16 569.16" class="shrink-0 sm:group-hover:animate-spin h-8 w-8 mr-2" width="32" height="32" role="img" aria-label="JdmLabs logo">
        <path d="m513.22 216.37c-18.427 0-31.318-4.568-34.492-12.218-3.17-7.647 2.702-19.982 15.704-32.999l39.602-39.602-6.493-6.49-83.474-83.44-6.49-6.49-6.49 6.49-33.079 33.082c-14.422 14.419-24.076 16.573-28.547 16.573-3.295 0-5.915-1.083-8.24-3.415-3.151-3.161-8.434-11.5-8.391-31.864 0-0.386-0.021-0.768-0.067-1.147v-54.846h-136.34v56.111c-0.024 8.229-1.3 35.166-16.741 35.166-4.464 0-14.104-2.154-28.519-16.576l-33.103-33.085-6.49-6.487-96.417 96.417 39.566 39.602c13.018 13.011 18.896 25.343 15.729 32.996-3.17 7.65-16.046 12.222-34.446 12.222h-55.998v136.39h55.995c18.396 0 31.273 4.568 34.443 12.219 3.173 7.656-2.705 20.004-15.722 33.025l-33.079 33.08-6.49 6.49 6.49 6.492 83.44 83.475 6.493 6.496 6.494-6.496 33.097-33.113c14.407-14.4 24.049-16.551 28.51-16.551 15.45 0 16.726 26.918 16.75 35.168v56.116h136.34v-54.842c0.046-0.377 0.067-0.752 0.067-1.135-0.042-20.373 5.239-28.713 8.391-31.871 2.329-2.334 4.951-3.42 8.25-3.42 4.471 0 14.125 2.148 28.544 16.539l33.069 33.104 6.49 6.498 6.493-6.496 83.474-83.471 6.493-6.492-6.496-6.494-33.112-33.082c-12.999-13.023-18.871-25.373-15.698-33.023 3.174-7.648 16.065-12.215 34.489-12.215h55.941v-136.4h-55.943zm-100.12 68.214c0 70.867-57.653 128.52-128.52 128.52s-128.52-57.652-128.52-128.52c0-70.867 57.653-128.52 128.52-128.52 70.866 0 128.52 57.653 128.52 128.52z"></path>
      </svg>
      <p itemprop="name" class="text-xl font-medium text-black">Ænginus</p>
    </a>
  </nav>

  <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="flex justify-center gap-x-2 gap-y-10 items-center" aria-label="Main navigation">
    <li>
      <a itemprop="url" class="px-4 py-2 hover:text-blue-500" href="{{ route('account') }}" wire:navigate><span>{{ __('Account') }}</span></a>
    </li>
    <li>
      <a itemprop="url" class="px-4 py-2 hover:text-blue-500" href="{{ route('logout') }}" wire:navigate onclick="event.preventDefault();document.getElementById('logoutForm').submit();"><span>{{ __('Logout') }}</span></a>
      <form id="logoutForm" class="sr-only" method="POST" action="{{ route('logout') }}">@csrf</form>
    </li>
  </menu>
</header>

<div class="flex flex-col relative lg:flex-row lg:pb-4">
  <aside class="grow relative min-h-full py-5 lg:w-1/5 lg:bg-slate-100 lg:border-r lg:border-r-400">
    <menu itemscope
        itemtype="https://schema.org/SiteNavigationElement"
        class="flex flex-wrap justify-center gap-x-4 max-w-none mt-0 text-xl md:text-2xl lg:flex-col lg:sticky lg:top-10 lg:text-xl"
        aria-label="Main"
    >
      <li class="group"{{ Route::currentRouteName() === 'dashboard' ? ' aria-selected=true' : '' }}>
        <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 active:bg-amber-200 hover:text-blue-500 lg:py-2 lg:px-4" href="{{ route('dashboard') }}" title="{{ __('Dashboard') }}"><span>{{ __('Dashboard') }}</span></a>
      </li>
      <li class="group"{{ Route::currentRouteAction() === Article\IndexController::class ? ' aria-selected=true' : '' }}>
        <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:py-2 lg:px-4" href="{{ action(Article\IndexController::class) }}" title="{{ __('Articles') }}"><span>{{ __('Articles') }}</span></a>
      </li>
      <li class="group"{{ Route::currentRouteAction() === Project\IndexController::class ? ' aria-selected=true' : '' }}>
        <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:py-2 lg:px-4" href="{{ action(Project\IndexController::class) }}" title="{{ __('Projects') }}"><span>{{ __('Projects') }}</span></a>
      </li>
      <li class="group"{{ Route::currentRouteAction() === Client\IndexController::class ? ' aria-selected=true' : '' }}>
        <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:py-2 lg:px-4" href="{{ action(Client\IndexController::class) }}" title="{{ __('Clients') }}"><span>{{ __('Clients') }}</span></a>
      </li>
      <li class="group"{{ Route::currentRouteAction() === Taxonomy\IndexController::class ? ' aria-selected=true' : '' }}>
        <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:py-2 lg:px-4" href="{{ action(Taxonomy\IndexController::class) }}" title="{{ __('Categories') }}"><span>{{ __('Categories') }}</span></a>
      </li>
    </menu>
  </aside>

  <main class="grow lg:w-4/5 lg:pt-1 lg:pl-4">
    {{--@if ($errors->any())
      <x-shared.session type="error" :message="$errors"/>
    @endif
    @if (session('status'))
      <x-shared.session type="info" :message="session('status')"/>
    @endif--}}

    {{ $slot }}
  </main>
</div>

<footer class="mt-10 px-2 py-5">
  <p class="site--credits text-center text-sm">
    &#169; <span itemprop="copyrightYear">2005</span>-<span itemprop="copyrightYear">2023</span>
    <span itemprop="name copyrightHolder" title="Jason D. Moss, Web Developer Extra(ordinaire)">Jason D. Moss</span>.
    <span class="rights">{{ __('All rights freely given') }} [<a itemprop="license" rel="external" href="/LICENSE.md" title="{{ __('The MIT License (MIT)') }}">MIT</a>].</span>
  </p>
</footer>
@stack('scripts')
<script defer src="{{ asset('/vendor/fa-solid.min.js') }}"></script>
<script defer src="{{ asset('/vendor/fa.min.js') }}"></script>
@vite('resources/assets/js/site.js')
</body></html>

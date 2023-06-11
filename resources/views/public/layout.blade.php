<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
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
@if (Request::is('/'))
  <title>{{ config('jdmlabs.title_home', 'JdmLabs') }}</title>
@elseif ($title)
  <title>{{ $title }} &#160;&#11825;&#160; {{ config('jdmlabs.title', 'JdmLabs') }}</title>
@endif
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
  font-weight: normal;
  font-display: swap;
  src: url("{{ Vite::asset('resources/assets/fonts/bmono--700.woff2') }}") format("woff2");
}
</style>
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://unpkg.com">
<link rel="dns-prefetch" href="https://unpkg.com">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ config('app.url') }}">
<meta property="og:title" content="@if ($title){{ $title }} &#160;&#11825;&#160; @endif{{ config('jdmlabs.title', 'JdmLabs') }}">
<meta property="og:description" content="{{ config('jdmlabs.description') }}">
<meta property="og:image" content="{{ Vite::asset('resources/assets/images/' . config('jdmlabs.image_share', '')) }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator:id" content="156621819">
<meta name="twitter:url" content="{{ config('app.url') }}">
<meta name="twitter:title" content="@if ($title){{ $title }} &#160;&#11825;&#160; @endif{{ config('jdmlabs.title', 'JdmLabs') }}">
<meta name="twitter:description" content="{{ config('jdmlabs.description') }}">
<meta name="twitter:image" content="{{ Vite::asset('resources/assets/images/' . config('jdmlabs.image_share', '')) }}">
<link rel="icon" href="{{ Vite::asset('resources/assets/images/icon/favicon.ico') }}" type="image/vnd.microsoft.icon">
<link rel="icon" href="{{ Vite::asset('resources/assets/images/icon/site-icon.svg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ Vite::asset('resources/assets/images/icon/site-icon--180.png') }}">
<link rel="manifest" href="{{ asset('jdmlabs.webmanifest') }}">
<link rel="profile" href="https://microformats.org/profile/hcard">
<link rel="profile me" href="https://mastodon.online/@jasondmoss">
<link rel="publisher" href="jasondmoss">
<livewire:styles/>
@vite('resources/assets/css/public.css')
</head><body itemscope itemtype="https://schema.org/{{ $schema }}" class="type--{{ $type }} {{ $page }}{{ Auth::check() ? ' logged-in': '' }}">

<header itemscope itemtype="https://schema.org/WPHeader" id="siteHeader" class="site--header">
  <nav itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="navigation site--branding">
    <a itemprop="url" rel="index" href="{{ config('app.url') }}" title="@yield('title')">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 569.16 569.16" class="site-logo" width="64" height="64" role="img" aria-label="JdmLabs logo">
        <path d="m513.22 216.37c-18.427 0-31.318-4.568-34.492-12.218-3.17-7.647 2.702-19.982 15.704-32.999l39.602-39.602-6.493-6.49-83.474-83.44-6.49-6.49-6.49 6.49-33.079 33.082c-14.422 14.419-24.076 16.573-28.547 16.573-3.295 0-5.915-1.083-8.24-3.415-3.151-3.161-8.434-11.5-8.391-31.864 0-0.386-0.021-0.768-0.067-1.147v-54.846h-136.34v56.111c-0.024 8.229-1.3 35.166-16.741 35.166-4.464 0-14.104-2.154-28.519-16.576l-33.103-33.085-6.49-6.487-96.417 96.417 39.566 39.602c13.018 13.011 18.896 25.343 15.729 32.996-3.17 7.65-16.046 12.222-34.446 12.222h-55.998v136.39h55.995c18.396 0 31.273 4.568 34.443 12.219 3.173 7.656-2.705 20.004-15.722 33.025l-33.079 33.08-6.49 6.49 6.49 6.492 83.44 83.475 6.493 6.496 6.494-6.496 33.097-33.113c14.407-14.4 24.049-16.551 28.51-16.551 15.45 0 16.726 26.918 16.75 35.168v56.116h136.34v-54.842c0.046-0.377 0.067-0.752 0.067-1.135-0.042-20.373 5.239-28.713 8.391-31.871 2.329-2.334 4.951-3.42 8.25-3.42 4.471 0 14.125 2.148 28.544 16.539l33.069 33.104 6.49 6.498 6.493-6.496 83.474-83.471 6.493-6.492-6.496-6.494-33.112-33.082c-12.999-13.023-18.871-25.373-15.698-33.023 3.174-7.648 16.065-12.215 34.489-12.215h55.941v-136.4h-55.943zm-100.12 68.214c0 70.867-57.653 128.52-128.52 128.52s-128.52-57.652-128.52-128.52c0-70.867 57.653-128.52 128.52-128.52 70.866 0 128.52 57.653 128.52 128.52z"></path>
      </svg>
      <p itemprop="name" class="site-name">JdmLabs</p>
      <p itemprop="slogan" class="site-slogan">
        <span>Compliant.</span> <span>Portable.</span> <span>Functional.</span>
      </p>
    </a>
  </nav>
  @if (auth()->check())
    <nav itemscope itemtype="https://schema.org/SiteNavigationElement" id="accountMain" class="navigation menu--account" aria-label="Main navigation">
      <menu>
        <li class="menu-item">
          <a href="{{ route('dashboard') }}" class="menu-link"><span>{{ __('Ænginus') }}</span></a>
        </li>
        <li class="menu-item">
          <a href="{{ route('account') }}" class="menu-link"><span>{{ __('Account') }}</span></a>
        </li>
        <li class="menu-item">
          <a href="{{ route('logout') }}" class="menu-link" onclick="event.preventDefault();document.getElementById('logoutForm').submit();"><span>{{ __('Logout') }}</span></a>
          <form id="logoutForm" class="sr-only" method="POST" action="{{ route('logout') }}">@csrf</form>
        </li>
      </menu>
    </nav>
  @endif
  <nav itemscope itemtype="https://schema.org/SiteNavigationElement" id="menuMain" class="navigation menu--main" aria-label="Main navigation">
    <menu>
      <li class="menu-item{{ Route::currentRouteName() == 'clients' ? ' active' : '' }}">
        <a class="menu-link" href="/clients" title="{{ __('Clients') }}"><span>{{ __('Clients') }}</span></a>
      </li>
      <li class="menu-item{{ Route::currentRouteName() == 'projects' ? ' active' : '' }}">
        <a class="menu-link" href="/projects" title="{{ __('Projects') }}"><span>{{ __('Projects') }}</span></a>
      </li>
      <li class="menu-item{{--{{ Route::currentRouteName() == 'public.article.index' ? ' active' : '' }}--}}">
        <a class="menu-link" href="/articles" title="{{ __('Articles') }}"><span>{{ __('Articles') }}</span></a>
      </li>
      <li class="menu-item{{ Route::currentRouteName() == 'about' ? ' active' : '' }}">
        <a class="menu-link" href="/about" title="{{ __('About') }}"><span>{{ __('About') }}</span></a>
      </li>
      <li class="menu-item{{ Route::currentRouteName() == 'now' ? ' active' : '' }}">
        <a class="menu-link" href="/now" title="{{ __('Now') }}"><span>{{ __('Now') }}</span></a>
      </li>
    </menu>
  </nav>
</header>

<main id="siteContent" class="site-container" aria-label="Main Content">
  @if ($errors->any())
    <x-shared.message type="error" context="general" :message="$errors"/>
  @endif
  @if (session('status'))
    <x-shared.message type="status" context="general" :message="session('status')"/>
  @endif
  {{ $slot }}
</main>

<footer itemscope itemtype="https://schema.org/WPFooter" id="siteFooter" class="container site--footer">
  @if (! Route::has('ae'))
    <nav itemscope itemtype="https://schema.org/SiteNavigationElement" id="profileLinks" class="navigation menu--profile" aria-label="Profile Links">
      <menu>
        <li>
          <a rel="noopener noreferrer" class="menu-link" href="https://www.behance.net/jasondmoss" title="{{ __('My profile at Behance') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" width="48" height="48" role="img" aria-label="Behance icon">
              <path d="m10.412 6.749c1.0532 0 2.0104 0.09002 2.8806 0.28206 0.86569 0.19504 1.6054 0.49511 2.228 0.9152 0.61514 0.42009 1.0997 0.97522 1.4403 1.6804 0.33758 0.70516 0.51011 1.5753 0.51011 2.5956 0 1.1102-0.25506 2.0404-0.76067 2.7906-0.50711 0.75017-1.2558 1.3503-2.2535 1.8304 1.3593 0.39009 2.3645 1.0802 3.0337 2.0555 0.67215 0.99022 0.99772 2.1755 0.99772 3.5408 0 1.1252-0.19504 2.0855-0.61514 2.8956-0.42009 0.82518-1.0052 1.5003-1.7404 2.0254-0.72016 0.52212-1.5753 0.9002-2.5056 1.1508-0.9152 0.24756-1.8784 0.38108-2.8656 0.38108h-10.759v-22.133h10.409zm15.006 18.247c0.66015 0.64214 1.6099 0.96471 2.8416 0.96471 0.8852 0 1.6504-0.22205 2.2955-0.67065 0.63614-0.4351 1.0202-0.9152 1.1703-1.4103h3.8829c-0.60463 1.9204-1.5723 3.3007-2.8506 4.1259-1.2753 0.84018-2.8266 1.2453-4.621 1.2453-1.2558 0-2.3765-0.19504-3.4088-0.60013-1.0097-0.40509-1.8604-0.97522-2.5806-1.7104-0.69615-0.73516-1.2348-1.6204-1.6159-2.6556-0.37958-1.0352-0.55962-2.1755-0.55962-3.4058 0-1.2048 0.20254-2.3105 0.60463-3.3457 0.40509-1.0502 0.96621-1.9204 1.6804-2.6856 0.74266-0.76517 1.5949-1.3428 2.6046-1.7914s2.1005-0.64964 3.3307-0.64964c1.3653 0 2.5356 0.24605 3.5708 0.78467 1.0052 0.51011 1.8304 1.2303 2.4906 2.1005 0.66015 0.87919 1.1252 1.8904 1.4103 3.0307 0.28506 1.1252 0.37508 2.3105 0.31507 3.5708h-11.538c0 1.2603 0.42009 2.4485 1.0652 3.0982l-0.12003 0.04501zm-15.363 0.07502c0.4756 0 0.93021-0.04501 1.3593-0.13953 0.4351-0.09002 0.82218-0.24756 1.1448-0.4501 0.31507-0.20254 0.58513-0.49211 0.78017-0.87469 0.19504-0.36008 0.28506-0.85519 0.28506-1.4403 0-1.1252-0.33007-1.9354-0.96021-2.4305-0.64514-0.48011-1.4853-0.72016-2.5356-0.72016h-5.2647v6.0763h5.1911v-0.04501zm20.415-8.4769c-0.52812-0.57763-1.4103-0.8882-2.486-0.8882-0.70216 0-1.2828 0.11102-1.7494 0.35708-0.4531 0.22505-0.82518 0.52512-1.1102 0.8852-0.28506 0.36008-0.4756 0.72016-0.58813 1.1252-0.11252 0.39009-0.18004 0.75017-0.20254 1.0652h7.1446c-0.10502-1.1252-0.49511-1.9504-1.0202-2.5356v0.015zm-20.685-0.92271c0.86119 0 1.5753-0.20104 2.138-0.61814 0.56112-0.40509 0.83118-1.0802 0.83118-2.0074 0-0.51611-0.10502-0.93771-0.27006-1.2693-0.19504-0.33007-0.4501-0.58513-0.75017-0.76817-0.31507-0.18604-0.67515-0.31507-1.0802-0.38558-0.40509-0.079518-0.84018-0.11102-1.2603-0.11102h-4.5445v5.1611h4.9361zm13.65-7.4386h8.954v2.1815h-8.954v-2.1995 0.015003z" stroke-width="1.5003"/>
            </svg>
            <span>{{ __('Behance') }}</span>
          </a>
        </li>
        <li>
          <a rel="noopener noreferrer" class="menu-link" href="https://github.com/jasondmoss" title="{{ __('My profile at GitHub') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" role="img" aria-label="Github icon">
              <path d="m12 0.29138c-6.6326 0-12.005 5.3721-12.005 12.005 0 5.3121 3.4364 9.7989 8.2083 11.39 0.60024 0.10504 0.82533-0.2551 0.82533-0.57023 0-0.28511-0.015006-1.2305-0.015006-2.2359-3.0162 0.55522-3.7965-0.73529-4.0366-1.4106-0.13505-0.34514-0.72029-1.4106-1.2305-1.6957-0.42017-0.22509-1.0204-0.78031-0.015006-0.79532 0.94538-0.01501 1.6206 0.87035 1.8457 1.2305 1.0804 1.8157 2.8061 1.3055 3.4964 0.99039 0.10504-0.78031 0.42017-1.3055 0.7653-1.6056-2.6711-0.30012-5.4622-1.3355-5.4622-5.9274 0-1.3055 0.46518-2.3859 1.2305-3.2263-0.12005-0.30012-0.54021-1.5306 0.12005-3.1813 0 0 1.0054-0.31513 3.3013 1.2305 0.96038-0.27011 1.9808-0.40516 3.0012-0.40516s2.0408 0.13505 3.0012 0.40516c2.2959-1.5606 3.3013-1.2305 3.3013-1.2305 0.66026 1.6507 0.2401 2.8811 0.12005 3.1813 0.7653 0.84033 1.2305 1.9058 1.2305 3.2263 0 4.6068-2.8061 5.6272-5.4772 5.9274 0.43517 0.37515 0.81032 1.0954 0.81032 2.2209 0 1.6056-0.01501 2.8962-0.01501 3.3013 0 0.31513 0.22509 0.69028 0.82533 0.57023a12.024 12.024 0 0 0 8.1783-11.39c0-6.6326-5.3721-12.005-12.005-12.005z" fill-rule="evenodd" stroke-width="1.5006"/>
            </svg>
            <span>{{ __('GitHub') }}</span>
          </a>
        </li>
        <li>
          <a rel="noopener noreferrer" class="menu-link" href="https://twitter.com/jasondmoss" title="{{ __('My profile at Twitter') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 465 465" width="48" height="48" role="img" aria-label="Twitter icon">
              <path d="m454.4 86.124c-7.3029 3.2391-14.811 5.9728-22.483 8.1922 9.0829-10.272 16.008-22.359 20.235-35.585 0.94774-2.9647-0.0345-6.2097-2.4713-8.1487-2.4338-1.9404-5.8154-2.1729-8.4951-0.58483-16.293 9.6633-33.871 16.608-52.302 20.669-18.566-18.142-43.783-28.466-69.852-28.466-55.027 0-99.795 44.767-99.795 99.792 0 4.3338 0.27442 8.6435 0.81728 12.893-68.283-5.9953-131.76-39.557-175.36-93.031-1.5536-1.906-3.9469-2.9332-6.3972-2.7367-2.4518 0.19195-4.6547 1.5746-5.8933 3.6994-8.8415 15.171-13.516 32.523-13.516 50.177 0 24.046 8.5851 46.86 23.75 64.687-4.6112-1.597-9.0859-3.593-13.357-5.9638-2.2928-1.2761-5.0911-1.2566-7.3689 0.0495-2.2794 1.3061-3.7084 3.7084-3.7684 6.3342-0.01049 0.44237-0.01049 0.88474-0.01049 1.3331 0 35.892 19.318 68.207 48.852 85.819-2.5373-0.25343-5.0731-0.62083-7.5923-1.1022-2.5973-0.49636-5.268 0.41388-7.0195 2.3948-1.7545 1.9794-2.3348 4.7387-1.5266 7.2579 10.932 34.13 39.077 59.235 73.103 66.889-28.22 17.675-60.493 26.934-94.371 26.934-7.069 0-14.178-0.41537-21.137-1.2386-3.4565-0.41089-6.7616 1.63-7.9387 4.9171-1.1772 3.2886 0.07048 6.955 3.0111 8.84 43.522 27.906 93.846 42.655 145.53 42.655 101.6 0 165.16-47.911 200.59-88.104 44.177-50.117 69.514-116.45 69.514-182 0-2.7382-0.042-5.5034-0.12596-8.2597 17.43-13.132 32.436-29.024 44.647-47.291 1.855-2.7742 1.654-6.4407-0.49486-8.9944-2.1459-2.5553-5.7224-3.3815-8.7755-2.0289z" stroke-width="1.4996"/>
            </svg>
            <span>{{ __('Twitter') }}</span>
          </a>
        </li>
        <li>
          <a rel="noopener noreferrer" class="menu-link" href="https://www.linkedin.com/in/jasondmoss" title="{{ __('My profile at LinkedIn') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 465 465" width="48" height="48" role="img" aria-label="LinkedIn icon">
              <g transform="matrix(1.4997 0 0 1.4997 .042718 .042718)">
                <path d="m72.16 99.73h-62.233c-2.762 0-5 2.239-5 5v199.93c0 2.762 2.238 5 5 5h62.233c2.762 0 5-2.238 5-5v-199.93c0-2.761-2.238-5-5-5z"/>
                <path d="M 41.066,0.341 C 18.422,0.341 0,18.743 0,41.362 0,63.991 18.422,82.4 41.066,82.4 63.692,82.4 82.099,63.99 82.099,41.362 82.1,18.743 63.692,0.341 41.066,0.341 Z"/>
                <path d="m230.45 94.761c-24.995 0-43.472 10.745-54.679 22.954v-12.985c0-2.761-2.238-5-5-5h-59.599c-2.762 0-5 2.239-5 5v199.93c0 2.762 2.238 5 5 5h62.097c2.762 0 5-2.238 5-5v-98.918c0-33.333 9.054-46.319 32.29-46.319 25.306 0 27.317 20.818 27.317 48.034v97.204c0 2.762 2.238 5 5 5h62.12c2.762 0 5-2.238 5-5v-109.66c0-49.565-9.451-100.23-79.546-100.23z"/>
              </g>
            </svg>
            <span>{{ __('LinkedIn') }}</span>
          </a>
        </li>
        <li>
          <a rel="noopener noreferrer" class="menu-link" href="https://www.last.fm/user/jasonmoss" title="{{ __('My profile at Last.fm') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 472.5 472.5" width="48" height="48" role="img" aria-label="Last.fm icon">
              <path d="m396.76 203.02c-4.0334-1.3805-7.9363-2.6604-11.685-3.8924-29.748-9.7549-40.034-13.973-40.034-30.537 0-14.363 10.202-24.398 24.808-24.398 11.983 0 20.26 4.9622 28.568 17.121 3.2351 4.7386 9.5253 6.2842 14.587 3.5848l28.732-15.313c2.6439-1.4075 4.6156-3.8128 5.4799-6.6818 0.8643-2.866 0.55069-5.9616-0.87331-8.5965-16.69-30.905-41.883-46.572-74.876-46.572-24.897 0-45.988 7.8432-61.002 22.683-14.882 14.71-22.748 35.192-22.748 59.227 0 50.428 31.957 71.287 87.125 90.265 31.578 10.97 38.961 15.211 38.961 31.693 0 20.374-17.597 35.163-41.842 35.163-0.72926 0-1.4705-0.012-2.2208-0.0375-26.075-0.91081-34.099-13.637-46.2-42.46-19.427-46.237-42.138-101.64-43.823-105.85-0.018-0.0465-0.0375-0.096-0.0555-0.14405-24.633-59.323-73.611-93.346-134.38-93.346-80.153 0-145.36 67.893-145.36 151.35 0 83.426 65.208 151.29 145.36 151.29 43.841 0 84.868-20.242 112.56-55.54 2.5119-3.2006 3.0971-7.5086 1.538-11.266l-17.318-41.686c-1.6881-4.0679-5.5954-6.7734-9.9935-6.9309-4.419-0.15756-8.484 2.2688-10.46 6.2047-14.971 29.86-44.219 48.41-76.33 48.41-47.504 0-86.151-40.594-86.151-90.486 0-49.907 38.647-90.512 86.151-90.512 34.556 0 66.173 21.417 78.675 53.293 0.0345 0.0825 0.0675 0.16656 0.10203 0.24909l42.876 102.01 4.9412 11.429c20.724 50.421 51.427 73.003 99.573 73.221h0.19957c57.542 0 100.94-40.062 100.94-93.187 0-53.267-29.02-73.838-75.826-89.758z" stroke-width="1.5005"/>
            </svg>
            <span>{{ __('Last.fm') }}</span>
          </a>
        </li>
        <li>
          <a rel="noopener noreferrer" class="menu-link" href="https://about.me/jasondmoss" title="{{ __('My profile at About.me') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48" height="48" role="img" aria-label="About.me icon">
              <path d="m39.07 18.294c-2.7457 0-4.2655 2.0278-4.5875 4.2315h9.2149c-0.24997-2.0998-1.7338-4.2295-4.6275-4.2295m-4.5195 7.2331c0.46994 2.3117 2.3857 3.9395 5.0634 3.9395 1.4498 0 3.5396-0.53994 4.7674-1.8278l2.3497 2.6997c-2.1277 2.2197-5.3054 2.8517-7.4791 2.8517-5.2794 0-9.3929-3.8116-9.3929-9.2109 0-5.0694 3.7876-9.2389 9.1389-9.2389 5.1694 0 8.9989 3.9595 8.9989 9.2069v1.5318h-13.444v0.04599zm-12.972 7.6591v-11.379c0-1.9518-0.8699-3.0716-2.6757-3.0716-1.6278 0-2.7097 1.1699-3.4336 2.0138v12.479h-4.6994v-11.399c0-1.9518-0.8299-3.0636-2.6357-3.0636-1.6258 0-2.7497 1.1719-3.4336 2.0118v12.479h-4.6974v-18.246h4.6994v2.2997c0.79991-0.92589 2.6037-2.5197 5.4194-2.5197 2.4937 0 4.1915 1.0519 4.9534 3.1796 1.0479-1.5218 2.9996-3.1796 5.8193-3.1796 3.3996 0 5.3794 2.0198 5.3794 5.9253v12.479h-4.7054l0.01-0.014z" stroke-width="1.9998"/>
            </svg>
            <span>{{ __('About.me') }}</span>
          </a>
        </li>
      </menu>
    </nav>
  @endif
  <p class="site--credits">
    &#169; <span itemprop="copyrightYear">2005</span>-<span itemprop="copyrightYear">2023</span>
    <span itemprop="name copyrightHolder" title="Jason D. Moss, Web Developer Extra(ordinaire)">Jason D. Moss</span>.
    <span class="rights">{{ __('All rights freely given') }} [<a itemprop="license" rel="external" href="/LICENSE.md" title="{{ __('The MIT License (MIT)') }}">MIT</a>].</span>
  </p>
</footer>

<livewire:scripts/>
<script defer src="{{ asset('/vendor/fa-solid.min.js') }}"></script>
<script defer src="{{ asset('/vendor/fa.min.js') }}"></script>
@vite('resources/assets/js/site.js')

</body></html>

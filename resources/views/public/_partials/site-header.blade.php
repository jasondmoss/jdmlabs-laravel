<header itemscope itemtype="https://schema.org/WPHeader" class="site--header">
  <nav itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="site--branding" aria-label="{{ __('Main logo and branding') }}">
    <a itemprop="url" rel="index" href="{{ config('app.url') }}" title="@yield('title')">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 569.16 569.16" class="site-logo" width="32" height="32" aria-hidden="true">
        <path d="m513.22 216.37c-18.427 0-31.318-4.568-34.492-12.218-3.17-7.647 2.702-19.982 15.704-32.999l39.602-39.602-6.493-6.49-83.474-83.44-6.49-6.49-6.49 6.49-33.079 33.082c-14.422 14.419-24.076 16.573-28.547 16.573-3.295 0-5.915-1.083-8.24-3.415-3.151-3.161-8.434-11.5-8.391-31.864 0-0.386-0.021-0.768-0.067-1.147v-54.846h-136.34v56.111c-0.024 8.229-1.3 35.166-16.741 35.166-4.464 0-14.104-2.154-28.519-16.576l-33.103-33.085-6.49-6.487-96.417 96.417 39.566 39.602c13.018 13.011 18.896 25.343 15.729 32.996-3.17 7.65-16.046 12.222-34.446 12.222h-55.998v136.39h55.995c18.396 0 31.273 4.568 34.443 12.219 3.173 7.656-2.705 20.004-15.722 33.025l-33.079 33.08-6.49 6.49 6.49 6.492 83.44 83.475 6.493 6.496 6.494-6.496 33.097-33.113c14.407-14.4 24.049-16.551 28.51-16.551 15.45 0 16.726 26.918 16.75 35.168v56.116h136.34v-54.842c0.046-0.377 0.067-0.752 0.067-1.135-0.042-20.373 5.239-28.713 8.391-31.871 2.329-2.334 4.951-3.42 8.25-3.42 4.471 0 14.125 2.148 28.544 16.539l33.069 33.104 6.49 6.498 6.493-6.496 83.474-83.471 6.493-6.492-6.496-6.494-33.112-33.082c-12.999-13.023-18.871-25.373-15.698-33.023 3.174-7.648 16.065-12.215 34.489-12.215h55.941v-136.4h-55.943zm-100.12 68.214c0 70.867-57.653 128.52-128.52 128.52s-128.52-57.652-128.52-128.52c0-70.867 57.653-128.52 128.52-128.52 70.866 0 128.52 57.653 128.52 128.52z"></path>
      </svg>
      <p itemprop="name" class="site-name">JdmLabs</p>
    </a>
    <p itemprop="slogan" class="site-slogan"><span>Compliant.</span> <span>Portable.</span> <span>Functional.</span></p>
  </nav>

  @if (auth()->check())
    <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="account" aria-label="{{ __('Administration menu') }}">
      <li>
        <a itemprop="url" href="{{ route('dashboard') }}"><span>{{ __('Ænginus') }}</span></a>
      </li>
      <li>
        <a itemprop="url" href="{{ route('account') }}"><span>{{ __('Account') }}</span></a>
      </li>
      <li>
        <a itemprop="url" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logoutForm').submit();"><span>{{ __('Logout') }}</span></a>
        <form id="logoutForm" class="sr-only" method="POST" action="{{ route('logout') }}">@csrf</form>
      </li>
    </menu>
  @endif

  <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="main" aria-label="{{ __('Main site menu') }}">
    <li{{ in_array(Route::currentRouteName(), [ 'article-list', 'article-single' ]) ? ' aria-selected=true' : '' }}>
      <a itemprop="url" href="/articles" title="{{ __('Articles') }}"><span>{{ __('Articles') }}</span></a>
    </li>
    <li{{ in_array(Route::currentRouteName(), [ 'project-list', 'project-single' ]) ? ' aria-selected=true' : '' }}>
      <a itemprop="url" href="/projects" title="{{ __('Projects') }}"><span>{{ __('Projects') }}</span></a>
    </li>
    <li{{ in_array(Route::currentRouteName(), [ 'client-list', 'client-single' ]) ? ' aria-selected=true' : '' }}>
      <a itemprop="url" href="/clients" title="{{ __('Clients') }}"><span>{{ __('Clients') }}</span></a>
    </li>
    <li{{ Route::is('about') ? ' aria-selected=true' : '' }}>
      <a itemprop="url" href="/about" title="{{ __('About') }}"><span>{{ __('About') }}</span></a>
    </li>
    <li{{ Route::is('now') ? ' aria-selected=true' : '' }}>
      <a itemprop="url" href="/now" title="{{ __('Now') }}"><span>{{ __('Now') }}</span></a>
    </li>
  </menu>
</header>

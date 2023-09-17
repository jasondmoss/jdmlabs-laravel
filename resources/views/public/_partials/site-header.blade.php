<header itemscope itemtype="https://schema.org/WPHeader" class="site--header">
  @include('public._partials.branding')
  @if (auth()->check())
    <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="account" tabindex="-1">
      <li><a itemprop="url" href="{{ route('clear-cache') }}"><span>{{ __('Clear Cache') }}</span></a></li>
      <li><a itemprop="url" wire:navigate href="{{ route('dashboard') }}"><span>{{ __('Ænginus') }}</span></a></li>
      <li><a itemprop="url" wire:navigate href="{{ route('account') }}"><span>{{ __('Account') }}</span></a></li>
      <li><a itemprop="url" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logoutForm').submit();"><span>{{ __('Logout') }}</span></a><form id="logoutForm" class="srt" method="POST" action="{{ route('logout') }}">@csrf</form></li>
    </menu>
  @endif

  <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="main" tabindex="-1">
    <li @if(Route::is('home')){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate class="srt" href="/" title="{{ __('Home') }}"><span>{{ __('Home') }}</span></a></li>
    <li @if(in_array(Route::currentRouteName(), [ 'article-list', 'article-single' ])){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/articles" title="{{ __('Articles') }}"><span>{{ __('Articles') }}</span></a></li>
    <li @if(in_array(Route::currentRouteName(), [ 'project-list', 'project-single' ])){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/projects" title="{{ __('Projects') }}"><span>{{ __('Projects') }}</span></a></li>
    <li @if(in_array(Route::currentRouteName(), [ 'client-list', 'client-single' ])){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/clients" title="{{ __('Clients') }}"><span>{{ __('Clients') }}</span></a></li>
    <li @if(Route::is('about')){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/about" title="{{ __('About') }}"><span>{{ __('About') }}</span></a></li>
    <li @if(Route::is('now')){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/now" title="{{ __('Now') }}"><span>{{ __('Now') }}</span></a></li>
  </menu>
</header>
<div class="panel">
  <button type="button" id="toggle" class="toggle-button toggle-background" title="{{ __('Menu toggle') }}" aria-label="{{ __('Overlay menu toggle button') }}">
    <span></span><span></span><span></span><span class="srt">{{ __('Menu') }}</span>
  </button>
  <button type="button" class="return-to-top" title="{{ __('Return to top of page') }}" aria-label="{{ __('Jump to the top button') }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 11l-5-5-5 5M17 18l-5-5-5 5"/></svg>
  </button>
  <div id="overlay" class="overlay">
    <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="main-clone">
      <li @if(Route::is('home')){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate class="srt" href="/" title="{{ __('Home') }}"><span>{{ __('Home') }}</span></a></li>
      <li @if(in_array(Route::currentRouteName(), [ 'article-list', 'article-single' ])){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/articles" title="{{ __('Articles') }}"><span>{{ __('Articles') }}</span></a></li>
      <li @if(in_array(Route::currentRouteName(), [ 'project-list', 'project-single' ])){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/projects" title="{{ __('Projects') }}"><span>{{ __('Projects') }}</span></a></li>
      <li @if(in_array(Route::currentRouteName(), [ 'client-list', 'client-single' ])){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/clients" title="{{ __('Clients') }}"><span>{{ __('Clients') }}</span></a></li>
      <li @if(Route::is('about')){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/about" title="{{ __('About') }}"><span>{{ __('About') }}</span></a></li>
      <li @if(Route::is('now')){!! 'aria-current="page"' !!}@endif><a itemprop="url" wire:navigate href="/now" title="{{ __('Now') }}"><span>{{ __('Now') }}</span></a></li>
    </menu>
@if (auth()->check())
    <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="account-clone">
      <li><a itemprop="url" href="{{ route('clear-cache') }}"><span>{{ __('Clear Cache') }}</span></a></li>
      <li><a itemprop="url" wire:navigate href="{{ route('dashboard') }}"><span>{{ __('Ænginus') }}</span></a></li>
      <li><a itemprop="url" wire:navigate href="{{ route('account') }}"><span>{{ __('Account') }}</span></a></li>
      <li><a itemprop="url" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logoutFormClone').submit();"><span>{{ __('Logout') }}</span></a><form id="logoutFormClone" class="srt" method="POST" action="{{ route('logout') }}">@csrf</form></li>
    </menu>
@endif
  </div>
</div>

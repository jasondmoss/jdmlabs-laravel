<header itemscope itemtype="https://schema.org/WPHeader" class="site--header">
  @include('public._partials.branding')
  @if (auth()->check())
    <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="account" tabindex="-1">
      <li><a itemprop="url" wire:navigate href="{{ route('dashboard') }}" title="{!! __('Ænginus dashboard') !!}">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.75 12.75h1.5a.75.75 0 000-1.5h-1.5a.75.75 0 000 1.5zM12 6a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 0112 6zM12 18a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 0112 18zM3.75 6.75h1.5a.75.75 0 100-1.5h-1.5a.75.75 0 000 1.5zM5.25 18.75h-1.5a.75.75 0 010-1.5h1.5a.75.75 0 010 1.5zM3 12a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 013 12zM9 3.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zM12.75 12a2.25 2.25 0 114.5 0 2.25 2.25 0 01-4.5 0zM9 15.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" /></svg> --}}
        <span>{{ __('Ænginus') }}</span>
      </a></li>
      <li><a itemprop="url" wire:navigate href="{{ route('account') }}" title="{!! __('Manage account/profile') !!}">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"/></svg> --}}
        <span>{{ __('Account') }}</span>
      </a></li>
      <li>
        <a itemprop="url" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logoutForm').submit();" title="{!! __('Logout of current session') !!}">
          {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z" clip-rule="evenodd" /></svg> --}}
          <span>{{ __('Logout') }}</span>
        </a>
        <form id="logoutForm" class="srt" method="POST" action="{{ route('logout') }}">@csrf</form>
      </li>
      <li><a itemprop="url" href="{{ route('clear-cache') }}" title="{!! __('Clear all cache') !!}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 5.25c1.213 0 2.415.046 3.605.135a3.256 3.256 0 013.01 3.01c.044.583.077 1.17.1 1.759L17.03 8.47a.75.75 0 10-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 00-1.06-1.06l-1.752 1.751c-.023-.65-.06-1.296-.108-1.939a4.756 4.756 0 00-4.392-4.392 49.422 49.422 0 00-7.436 0A4.756 4.756 0 003.89 8.282c-.017.224-.033.447-.046.672a.75.75 0 101.497.092c.013-.217.028-.434.044-.651a3.256 3.256 0 013.01-3.01c1.19-.09 2.392-.135 3.605-.135zm-6.97 6.22a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.752-1.751c.023.65.06 1.296.108 1.939a4.756 4.756 0 004.392 4.392 49.413 49.413 0 007.436 0 4.756 4.756 0 004.392-4.392c.017-.223.032-.447.046-.672a.75.75 0 00-1.497-.092c-.013.217-.028.434-.044.651a3.256 3.256 0 01-3.01 3.01 47.953 47.953 0 01-7.21 0 3.256 3.256 0 01-3.01-3.01 47.759 47.759 0 01-.1-1.759L6.97 15.53a.75.75 0 001.06-1.06l-3-3z" clip-rule="evenodd"/></svg>
        <span class="srt">{{ __('Clear Cache') }}</span>
      </a></li>
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

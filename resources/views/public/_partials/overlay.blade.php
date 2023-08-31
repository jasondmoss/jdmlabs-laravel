<div class="panel">
  <button type="button" id="toggle" class="toggle-button toggle-background" title="{{ __('Menu toggle') }}" aria-label="{{ __('Overlay menu toggle button') }}">
    <span></span><span></span><span></span><span class="sr-only">{{ __('Menu') }}</span>
  </button>
  <button type="button" class="return-to-top" title="{{ __('Return to top of page') }}" aria-label="{{ __('Jump to the top button') }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 11l-5-5-5 5M17 18l-5-5-5 5"/></svg>
  </button>
  <div class="overlay">
    <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="main-clone" aria-label="{{ __('Overlay clone of the main site menu') }}">
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
    @if (auth()->check())
      <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="account-clone" aria-label="{{ __('Overlay clone of the administration menu') }}">
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
  </div>
</div>

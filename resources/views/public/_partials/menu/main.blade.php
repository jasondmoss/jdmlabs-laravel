<menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="main{{ $context }}" tabindex="-1">
  <li class="srt" @if(Route::is('home')){!! 'aria-current="page"' !!}@endif>
    <a itemprop="url" wire:navigate class="srt" href="/" title="{{ __('Home') }}">
      <span>{{ __('Home') }}</span>
    </a>
  </li>
  <li @if(in_array(Route::currentRouteName(), ['article-list', 'article-single'])){!! 'aria-current="page"' !!}@endif>
    <a itemprop="url" wire:navigate href="/articles" title="{{ __('Articles') }}">
      <span>{{ __('Articles') }}</span>
    </a>
  </li>
  <li @if(in_array(Route::currentRouteName(), ['project-list', 'project-single'])){!! 'aria-current="page"' !!}@endif>
    <a itemprop="url" wire:navigate href="/projects" title="{{ __('Projects') }}">
      <span>{{ __('Projects') }}</span>
    </a>
  </li>
  <li @if(in_array(Route::currentRouteName(), ['client-list', 'client-single'])){!! 'aria-current="page"' !!}@endif>
    <a itemprop="url" wire:navigate href="/clients" title="{{ __('Clients') }}">
      <span>{{ __('Clients') }}</span>
    </a>
  </li>
  <li @if(Route::is('about')){!! 'aria-current="page"' !!}@endif>
    <a itemprop="url" wire:navigate href="/about" title="{{ __('About') }}">
      <span>{{ __('About') }}</span>
    </a>
  </li>
  <li @if(Route::is('now')){!! 'aria-current="page"' !!}@endif>
    <a itemprop="url" wire:navigate href="/now" title="{{ __('Now') }}">
      <span>{{ __('Now') }}</span>
    </a>
  </li>
</menu>

<aside class="panel">
  <div>
    <button popovertarget="overlay" popovertargetaction="show" title="{{ __('Menu toggle') }}" aria-label="{{ __('Overlay menu toggle button') }}">
      <span></span><span></span><span></span><span class="srt">{{ __('Menu') }}</span>
    </button>

    <button type="button" class="return-to-top" title="{{ __('Return to top of page') }}" aria-label="{{ __('Jump to the top button') }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 11l-5-5-5 5M17 18l-5-5-5 5"/>
      </svg>
    </button>
  </div>

  <dialog popover id="overlay" class="overlay">
    <header>
      <h2>{{ __('Menu') }}</h2>
      <button popovertarget="overlay" popovertargetaction="hide">X</button>
    </header>

    <x-public._partials.menu.main context=" clone" />

    @if (auth()->check())
      <x-public._partials.menu.admin context=" clone" />
    @endif
  </dialog>
</aside>

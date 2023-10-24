@include("public._partials.prolog")
<body itemscope itemtype="https://schema.org/{{ $schema }}" class="{{ Auth::check() ? 'logged-in ': '' }}page--{{ $page }} {{ $context }}">

<ul class="a11y-nav">
  <li><a class="" href="#">Skip to main content</a></li>
  <li><a class="" href="#">Skip to navigation</a></li>
</ul>

<div class="exo">
  <x-public._partials.overlay />

  <div class="endo">
    <header itemscope itemtype="https://schema.org/WPHeader">
      <x-public._partials.menu.branding />

      @if (auth()->check())
        <x-public._partials.menu.admin context="" />
      @endif

      <x-public._partials.menu.main context="" />
    </header>

    <main aria-label="Main Content">
      {{ $slot }}
    </main>

    <footer itemscope itemtype="https://schema.org/WPFooter">
      @if (! Route::has('ae'))
        <x-public._partials.menu.ego />
      @endif

      <p class="credits">
        &#169; <span itemprop="copyrightYear">2005</span>-<span itemprop="copyrightYear">2023</span>
        <span itemprop="name copyrightHolder" title="Jason D. Moss, Web Developer Extra(ordinaire)">Jason D. Moss</span>.
        <span>{{ __('All rights freely given') }} [<a itemprop="license" rel="external" href="{{ url('/LICENSE.md') }}" title="{{ __('The MIT License (MIT)') }}">MIT</a>].</span>
      </p>
    </footer>
  </div>
</div>

@vite('resources/assets/js/public.js')
</body></html>

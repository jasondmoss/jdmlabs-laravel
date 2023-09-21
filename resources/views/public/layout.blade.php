<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
@include('public._partials.prolog')
</head><body itemscope itemtype="https://schema.org/{{ $schema }}" class="{{ Auth::check() ? 'logged-in ': '' }}page{{ $page . $context }}">
<ul class="a11y-nav">
  <li><a class="" href="#">Skip to main content</a></li>
  <li><a class="" href="#">Skip to navigation</a></li>
</ul>
<div class="exo">
  @include('public._partials.overlay')
  <div class="endo">
    @include('public._partials.site-header')
    <main class="site--body" aria-label="Main Content">
      {{ $slot }}
    </main>
    @include('public._partials.site-footer')
  </div>
  <div id="FocusPlate" class="focusplate"></div>
</div>
@vite('resources/assets/js/public.js')
</body></html>

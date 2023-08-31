<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('public._partials.prolog')
</head>
<body itemscope itemtype="https://schema.org/{{ $schema }}" class="{{ Auth::check() ? 'logged-in ': '' }}page{{ $page . $context }}">
<div class="exo">
  @include('public._partials.overlay')
  <div class="endo">
    @include('public._partials.site-header')
    <main class="site--body" aria-label="Main Content">
      {{ $slot }}
    </main>
    @include('public._partials.site-footer')
  </div>
</div>
@vite('resources/assets/js/public.js')
</body>
</html>

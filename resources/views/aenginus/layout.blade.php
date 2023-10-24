@include("aenginus._partials.prolog")
<body class="admin {{ Auth::check() ? 'logged-in ': '' }}page--{{ $page }} {{ $context }} max-w-screen-xl mx-auto cursor-default">

<header id="adminHeader" class="flex flex-wrap justify-between pb-0 pt-0 pr-4 border-solid border-b-2 border-slate-200 sm:bg-red-200 md:bg-lime-200 lg:pb-0 lg:bg-sky-200 xl:bg-yellow-200">
  <nav class="flex justify-center">
    <a itemprop="url" rel="index" class="group p-4 lg:p-6 max-w-sm flex align-middle items-center space-x-4" href="{{ config('app.url') }}" title="@yield('title')">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 569.16 569.16" class="shrink-0 sm:group-hover:animate-spin h-8 w-8 mr-2" width="32" height="32" role="img" aria-label="JdmLabs logo">
        <path d="m513.22 216.37c-18.427 0-31.318-4.568-34.492-12.218-3.17-7.647 2.702-19.982 15.704-32.999l39.602-39.602-6.493-6.49-83.474-83.44-6.49-6.49-6.49 6.49-33.079 33.082c-14.422 14.419-24.076 16.573-28.547 16.573-3.295 0-5.915-1.083-8.24-3.415-3.151-3.161-8.434-11.5-8.391-31.864 0-0.386-0.021-0.768-0.067-1.147v-54.846h-136.34v56.111c-0.024 8.229-1.3 35.166-16.741 35.166-4.464 0-14.104-2.154-28.519-16.576l-33.103-33.085-6.49-6.487-96.417 96.417 39.566 39.602c13.018 13.011 18.896 25.343 15.729 32.996-3.17 7.65-16.046 12.222-34.446 12.222h-55.998v136.39h55.995c18.396 0 31.273 4.568 34.443 12.219 3.173 7.656-2.705 20.004-15.722 33.025l-33.079 33.08-6.49 6.49 6.49 6.492 83.44 83.475 6.493 6.496 6.494-6.496 33.097-33.113c14.407-14.4 24.049-16.551 28.51-16.551 15.45 0 16.726 26.918 16.75 35.168v56.116h136.34v-54.842c0.046-0.377 0.067-0.752 0.067-1.135-0.042-20.373 5.239-28.713 8.391-31.871 2.329-2.334 4.951-3.42 8.25-3.42 4.471 0 14.125 2.148 28.544 16.539l33.069 33.104 6.49 6.498 6.493-6.496 83.474-83.471 6.493-6.492-6.496-6.494-33.112-33.082c-12.999-13.023-18.871-25.373-15.698-33.023 3.174-7.648 16.065-12.215 34.489-12.215h55.941v-136.4h-55.943zm-100.12 68.214c0 70.867-57.653 128.52-128.52 128.52s-128.52-57.652-128.52-128.52c0-70.867 57.653-128.52 128.52-128.52 70.866 0 128.52 57.653 128.52 128.52z"></path>
      </svg>
      <p itemprop="name" class="text-xl font-medium text-black">Ænginus</p>
    </a>
  </nav>

  <menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="flex justify-center gap-x-2 gap-y-10 items-center" aria-label="Main navigation">
    <li>
      <a itemprop="url" class="px-4 py-2 hover:text-blue-500" href="{{ route('account') }}" wire:navigate><span>{{ __('Account') }}</span></a>
    </li>
    <li>
      <a itemprop="url" class="px-4 py-2 hover:text-blue-500" href="{{ route('logout') }}" wire:navigate onclick="event.preventDefault();document.getElementById('logoutForm').submit();"><span>{{ __('Logout') }}</span></a>
      <form id="logoutForm" class="sr-only" method="POST" action="{{ route('logout') }}">@csrf</form>
    </li>
  </menu>
</header>

<div id="adminBody" class="flex flex-col relative lg:flex-row lg:pb-4">
  <aside class="grow relative min-h-full py-5 lg:basis-1/6 lg:bg-slate-100 lg:border-r lg:border-r-400">
    <x-aenginus._partials.menu />
  </aside>

  <main class="grow lg:basis-10/12 lg:pt-1 lg:pl-2">
    {{ $slot }}
  </main>
</div>

<footer id="adminFooter" class="mt-10 px-2 py-5">
  <p class="site--credits text-center text-sm">
    &#169; <span itemprop="copyrightYear">2005</span>-<span itemprop="copyrightYear">2023</span>
    <span itemprop="name copyrightHolder" title="Jason D. Moss, Web Developer Extra(ordinaire)">Jason D. Moss</span>.
    <span class="rights">{{ __('All rights freely given') }} [<a itemprop="license" rel="external" href="{{ url('/LICENSE.md') }}" title="{{ __('The MIT License (MIT)') }}">MIT</a>].</span>
  </p>
</footer>

@stack('scripts')
@vite('resources/assets/js/aenginus.js')
</body></html>

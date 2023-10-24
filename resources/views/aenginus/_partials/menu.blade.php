@php
  use Aenginus\Article\Interface\Web\Controllers as Article;
  use Aenginus\Project\Interface\Web\Controllers as Project;
  use Aenginus\Client\Interface\Web\Controllers as Client;
  use Aenginus\Taxonomy\Interface\Web\Controllers as Taxonomy;
@endphp
<menu itemscope itemtype="https://schema.org/SiteNavigationElement" class="flex flex-wrap justify-center gap-x-4 max-w-none mt-0 px-1 text-xl md:text-2xl lg:flex-col lg:sticky lg:top-10 lg:text-xl" aria-label="Main">
  <li class="group"{{ Route::currentRouteName() === 'dashboard' ? ' aria-selected=true' : '' }}>
    <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 active:bg-amber-200 hover:ext-blue-500 lg:p-4 xl:my-2" href="{{ route('dashboard') }}" title="{{ __('Dashboard') }}">
      <span>{{ __('Dashboard') }}</span></a>
  </li>
  <li class="group"{{ in_array(Route::currentRouteName(), [
    'ae-article-list',
    'ae-article-create',
    'ae-article-edit'
  ]) ? ' aria-selected=true' : '' }}>
    <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:p-4 xl:my-2" href="{{ action(Article\IndexController::class) }}" title="{{ __('Articles') }}">
      <span>{{ __('Articles') }}</span></a>
  </li>
  <li class="group"{{ in_array(Route::currentRouteName(), [
    'ae-project-list',
    'ae-project-create',
    'ae-project-edit'
  ]) ? ' aria-selected=true' : '' }}>
    <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:p-4 xl:my-2" href="{{ action(Project\IndexController::class) }}" title="{{ __('Projects') }}">
      <span>{{ __('Projects') }}</span></a>
  </li>
  <li class="group"{{ in_array(Route::currentRouteName(), [
    'ae-client-list',
    'ae-client-create',
    'ae-client-edit'
  ]) ? ' aria-selected=true' : '' }}>
    <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:p-4 xl:my-2" href="{{ action(Client\IndexController::class) }}" title="{{ __('Clients') }}">
      <span>{{ __('Clients') }}</span></a>
  </li>
  <li class="group"{{ in_array(Route::currentRouteName(), [
    'ae-category-list',
    'ae-category-create',
    'ae-category-edit'
  ]) ? ' aria-selected=true' : '' }}>
    <a itemprop="url" class="block p-2 hover:bg-amber-50 group-aria-selected:bg-amber-200 hover:text-blue-500 lg:p-4 xl:my-2" href="{{ action(Taxonomy\IndexController::class) }}" title="{{ __('Categories') }}">
      <span>{{ __('Categories') }}</span></a>
  </li>
</menu>

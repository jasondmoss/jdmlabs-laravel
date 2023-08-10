@php
  use Aenginus\Taxonomy\Interface\Web\Controllers as Category;
@endphp

<!-- list.blade -->
<div class="listing-wrapper flex flex-col gap-y-10">

  <header id="listingHeader" class="listing-header flex align-middle justify-between sticky mt-0">
    <h1 class="text-4xl">{{ __('Categories') }}</h1>

    <nav class="listing-tools flex items-center gap-x-10">
      <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ action(Category\CreateController::class) }}">Create New Category</a>

      <form wire:submit="search" wire:model="query" class="list-search">
        <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="form-input--text" placeholder="Search"> </label>
      </form>
    </nav>
  </header>

  @if ($categories->count())
    <div class="listing taxonomy category flex flex-wrap">
      @foreach ($categories as $cat)
        <article id="item-{{ $cat->id }}" class="flex flex-col gap-y-3 odd:bg-white even:bg-slate-100 hover:bg-amber-50 p-10 w-full lg:w-1/2 xl:w-1/3">
          <header class="item--header">
            <h3 class="title text-2xl">
              <a class="text-blue-500" href="{{ action(Category\EditController::class, $cat->id) }}" title="{{ __('Edit') }}">{{ $cat->name }}</a>
            </h3>
          </header>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $cat->id }}</p>

          <ul class="item--count" style="color: #007741;">
            <li class="article"><strong class="label">{{ __('Articles') }}:</strong> {{ $cat->articles_count }}</li>
          </ul>

          <footer class="item--actions">
            <menu class="flex gap-4">
              <li>
                <i class="fa-solid fa-pen-to-square"></i>
                <a class="text-blue-500" href="{{ action(Category\EditController::class, $cat->id) }}" title="{{ __('Edit article') }}">{{ __('Edit') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-trash"></i>
                <a class="text-blue-500" href="{{ action(Category\DestroyController::class, $cat->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete article') }}">{{ __('Delete') }}</a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Category\DestroyController::class, $cat->id) }}">@csrf {{ method_field('DELETE') }}</form>
              </li>
            </menu>
          </footer>
        </article>

      @endforeach
    </div>

    {{-- Pagination. --}}
    {{ $categories->links() }}
  @endif
</div>

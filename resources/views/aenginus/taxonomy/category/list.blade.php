@php
  use Aenginus\Taxonomy\Interface\Web\Controllers as Category;
@endphp

<!-- list.blade -->
<div class="listing-wrapper flex flex-col gap-y-10">

  <header id="listingHeader" class="flex flex-col md:flex-row md:justify-between gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-7 xl:pb-6">
    <h1 class="text-center pl-2 text-4xl font-medium">{{ __('Categories') }}</h1>

    <nav class="listing-tools flex items-center gap-x-10">
      <a class="bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm" href="{{ action(Category\CreateController::class) }}">New Category</a>

      <form wire:submit="search" wire:model="query" class="list-search">
        <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="form-input--text" placeholder="Search"> </label>
      </form>
    </nav>
  </header>

  @if ($categories->count())
    <div class="listing taxonomy category flex flex-wrap">
      @foreach ($categories as $cat)
        <article id="item-{{ $cat->id }}" class="flex flex-col gap-y-3 border-b odd:bg-white even:bg-slate-100 hover:bg-amber-50 p-5 w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
          <header class="item--header">
            <h3 class="text-lg"><a class="text-blue-500" href="{{ action(Category\EditController::class, $cat->id) }}" title="{{ __('Edit') }}">{{ $cat->name }}</a></h3>
          </header>

          {{-- <p class="flex gap-x-3" title="{{ __('Taxonomy Ulid') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default icon-default-fill mt-0.5"><path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 00-3.722 1.118.75.75 0 11-.828-1.25 8.25 8.25 0 0112.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 01-1.395-.551A21.69 21.69 0 0018.75 10.5 6.75 6.75 0 0012 3.75zM6.157 5.739a.75.75 0 01.21 1.04A6.715 6.715 0 005.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 01-1.27-.8A6.715 6.715 0 003.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 011.04-.211zM12 7.5a3 3 0 00-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 11-1.112-1.008A10.459 10.459 0 007.5 10.5a4.5 4.5 0 119 0c0 .547-.022 1.09-.067 1.626a.75.75 0 01-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 00-3-3zm0 2.25a.75.75 0 01.75.75A15.69 15.69 0 018.97 20.738a.75.75 0 01-1.14-.975A14.19 14.19 0 0011.25 10.5a.75.75 0 01.75-.75zm3.239 5.183a.75.75 0 01.515.927 19.415 19.415 0 01-2.585 5.544.75.75 0 11-1.243-.84 17.912 17.912 0 002.386-5.116.75.75 0 01.927-.515z" clip-rule="evenodd" /></svg>
            {{ $cat->id }}
          </p> --}}

          <ul class="flex flex-col gap-y-2 w-24">
            <li class="flex justify-between"><strong class="font-medium">{{ __('Articles') }}:</strong> {{ $cat->articles_count }}</li>
            <li class="flex justify-between"><strong class="font-medium">{{ __('Projects') }}:</strong> {{ $cat->projects_count }}</li>
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
  @else
    <p>{{ __('No categories available.') }}</p>
  @endif

</div>

<?php
  use Aenginus\Article\Interface\Web\Controllers as Article;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Aenginus\Taxonomy\Interface\Web\Controllers as Taxonomy;
  use Carbon\Carbon;
  use Illuminate\Support\Facades\Date;
?>

<!-- list.blade -->
<div class="relative">

  <header id="listingHeader" class="flex flex-col md:flex-row md:justify-between gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-7 xl:pb-6">
    <h1 class="text-center pl-2 text-4xl font-medium">{{ __('Articles') }}</h1>

    <nav class="flex flex-wrap justify-center items-center gap-10 sm:flex-row">
      <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-sm" href="{{ action(Article\CreateController::class) }}">Create New Article</a>

      <form wire:submit="search" wire:model="query" class="flex justify-center w-full px-5 sm:w-auto">
        <label for="search" class="w-full">
          <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black" placeholder="Search">
        </label>
      </form>
    </nav>
  </header>

  <div class="listing article flex flex-col overflow-x-auto">
    @if ($articles->count())
      <table class="flex flex-col gap-y-4 max-w-sm mx-auto mt-10 mb-0 md:table md:max-w-full md:m-0 lg:mt-4 text-left text-sm font-light">
        <thead class="hidden md:table-header-group border-b font-medium dark:border-neutral-500">
          <tr>
            <th scope="col" class="md:w-16 md:px-6 py-2 my-2">{{ __('Signature') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Title') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Updated') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Actions') }}</th>
          </tr>
        </thead>

        <tbody class="flex flex-col gap-y-10 md:table-row-group w-full">
          @foreach ($articles as $article)
            @php $permalink = url('/article/' . Carbon::parse($article->published_at)->format('Y/m/d') . '/' . $article->slug); @endphp

            <!-- Item -->
            <tr class="flex flex-col max-w-full md:table-row border-b dark:border-neutral-500 odd:bg-white even:bg-slate-50">
              <td class="block w-full md:table-cell md:w-16 py-2">
                <figure class="">
                  <a class="block" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
                    @if ($article->hasMedia('signature'))
                      <img class="max-w-full mx-auto" src="{{ $article->getFirstMediaUrl('signature', 'thumb100') }}" alt="">
                    @else
                      <img class="max-w-full mx-auto" src="{{ asset('images/placeholder/signature.png') }}" alt="">
                    @endif
                  </a>
                </figure>
              </td>
              <td class="block md:table-cell md:align-top md:px-6 py-6"><div class="flex flex-col gap-3">
                <a rel="external" class="font-bold text-base xl:text-xl text-blue-500 hover:text-black" href="{{ $permalink }}" title="{{ __('View') }}">{{ $article->title }}</a>
                <p><strong>{{ __('ID') }}:</strong> {{ $article->id }}</p>
                @if ($article->category !== null)
                  <p class="flex align-middle">
                    <i class="fa-solid fa-tag self-center mr-4 text-md text-slate-400"></i>
                    <a itemprop="tag" class="px-3 py-1 shadow-sm bg-amber-200 hover:bg-amber-300 rounded-md text-xs font-medium text-amber-900" href="{{ action(Taxonomy\EditController::class, $article->category->id) }}" title="{{ __('Edit category') }}">{{ $article->category->name }}</a>
                  </p>
                @endif
              </div></td>
              <td class="block py-6 font-medium md:table-cell md:align-top md:w-32 md:px-6 lg:w-56">
                <time class="flex md:justify-end gap-x-4 pt-1 text-lg lg:text-base" datetime="{{ Date::parse($article->updated_at)->format('c') }}" title="{{ Date::parse($article->updated_at)->format('c') }}">
                  {{ Date::parse($article->updated_at)->format('Y/m/d \\@ H:i:s') }}
                </time>
              </td>
              <td class="block py-6 md:table-cell md:align-top md:w-32 md:px-6"><div
                  x-data="{
                    open: false,
                    toggle() {
                        if (this.open) {
                            return this.close()
                        }
                        this.$refs.button.focus()
                        this.open = true
                    },
                    close(focusAfter) {
                        if (! this.open) {
                            return
                        }
                        this.open = false
                        focusAfter && focusAfter.focus()
                    }
                  }"
                  x-on:keydown.escape.prevent.stop="close($refs.button)"
                  x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                  x-id="['dropdown-button']"
                  class="relative float-right"
              >
                <div class="inline-flex overflow-hidden rounded-sm divide-x divide-amber-300 border border-amber-300 shadow-md shadow-amber-50">
                  <a class="flex items-center space-x-2 px-4 py-1 bg-amber-100 hover:bg-amber-300 text-center text-sm font-medium text-amber-600 hover:text-amber-800" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit article') }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>{{ __('Edit') }}</span>
                  </a>
                  <button type="button"
                      x-ref="button"
                      x-on:click="toggle()"
                      :aria-expanded="open"
                      :aria-controls="$id('dropdown-button')"
                      class="flex items-center px-2 py-1 group bg-amber-50 hover:bg-amber-300 text-center text-sm font-medium text-secondary-700"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 fill-amber-700 group-hover:text-amber-900">
                      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
                <div class="absolute right-0 z-10 mt-2 w-32 rounded-sm border border-gray-100 bg-white text-left text-sm drop-shadow-xl"
                    x-ref="panel"
                    x-show="open"
                    x-transition.origin.top.left
                    x-on:click.outside="close($refs.button)"
                    :id="$id('dropdown-button')"
                >
                  <div class="flex flex-col gap-y-1">
                    <a href="{{ action(Article\DestroyController::class, $article->id) }}"
                        onclick="event.preventDefault();document.getElementById('deleteForm').submit();"
                        class="flex items-center group w-full rounded-sm px-3 py-2 divide-x divide-slate-300 space-x-3 text-gray-700 font-medium hover:bg-red-500 hover:text-white"
                    >
                      <i class="fa-solid fa-trash w-5 group-hover:text-white"></i>
                      <span class="pl-3">{{ __('Delete') }}</span>
                    </a>
                    <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Article\DestroyController::class, $article->id) }}">@csrf{{ method_field('DELETE') }}</form>
                    <a rel="external" href="{{ $permalink }}" class="flex items-center group w-full rounded-sm px-3 py-2 divide-x divide-slate-300 space-x-3 text-gray-700 font-medium hover:bg-lime-500 hover:text-white">
                      <i class="fa-solid fa-eye w-5 group-hover:text-white"></i>
                      <span class="pl-3">{{ __('View') }}</span>
                    </a>
                  </div>
                </div>
              </div></td>
            </tr>
            <!-- \Item -->
          @endforeach

        </tbody>

        <tfoot class="block md:table-footer-group">
          <tr>
            <td colspan="4">
              {{ $articles->links() }}
            </td>
          </tr>
        </tfoot>
      </table>
    @else
      <div class="w-full mt-8 p-20">
        <strong>No articles found.</strong>
      </div>
    @endif
  </div>
</div>

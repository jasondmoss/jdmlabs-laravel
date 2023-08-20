<?php
  use Aenginus\Article\Interface\Web\Controllers as Article;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel as Category;
  use Aenginus\Taxonomy\Interface\Web\Controllers as Taxonomy;
  use Carbon\Carbon;
  use Illuminate\Support\Facades\Date;
?>

<!-- list.blade -->
<div class="relative">

  <header id="listingHeader" class="flex flex-col md:flex-row md:justify-between gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-7 xl:pb-6">
    <h1 class="text-center pl-2 text-4xl font-medium">{{ __('Articles') }}</h1>

    <nav class="flex flex-wrap justify-center items-center gap-10 sm:flex-row">
      <a class="bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm" href="{{ action(Article\CreateController::class) }}">New Article</a>

      <form wire:submit="search" wire:model="query" class="flex justify-center w-full px-5 sm:w-auto">
        <label for="search" class="w-full">
          <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black" placeholder="{{ __('Search') }}">
        </label>
      </form>
    </nav>
  </header>

  <div class="listing article flex flex-col overflow-x-auto">
    @if ($articles->count())
      <table class="flex flex-col gap-y-4 max-w-sm mx-auto mt-10 mb-0 md:table md:max-w-full md:m-0 lg:mt-4 text-left text-sm font-medium">
        <thead class="hidden md:table-header-group border-b dark:border-neutral-500">
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
            <tr id="item-{{ $article->id }}" class="flex flex-col max-w-full md:table-row border-b odd:bg-white even:bg-slate-50">
              <td class="block w-full md:table-cell md:w-16 py-2">
                <figure class="">
                  <a class="block" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
                    @if ($article->hasMedia('signature'))
                      <img class="w-28 h-28 mx-auto" src="{{ $article->getFirstMediaUrl('signature', 'thumb100') }}" alt="">
                    @else
                      <img class="w-28 h-28 mx-auto" src="{{ asset('images/placeholder/signature.png') }}" alt="">
                    @endif
                  </a>
                </figure>
              </td>
              <td class="block md:table-cell md:align-top md:px-6 py-6"><div class="flex flex-col gap-3">
                <a rel="external" class="font-bold text-base xl:text-xl text-sky-600 hover:text-black" href="{{ $permalink }}" title="{{ __('View article') }}">{{ $article->title }}</a>
                <p class="flex gap-x-3" title="{{ __('Article Ulid') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5"><path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 00-3.722 1.118.75.75 0 11-.828-1.25 8.25 8.25 0 0112.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 01-1.395-.551A21.69 21.69 0 0018.75 10.5 6.75 6.75 0 0012 3.75zM6.157 5.739a.75.75 0 01.21 1.04A6.715 6.715 0 005.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 01-1.27-.8A6.715 6.715 0 003.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 011.04-.211zM12 7.5a3 3 0 00-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 11-1.112-1.008A10.459 10.459 0 007.5 10.5a4.5 4.5 0 119 0c0 .547-.022 1.09-.067 1.626a.75.75 0 01-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 00-3-3zm0 2.25a.75.75 0 01.75.75A15.69 15.69 0 018.97 20.738a.75.75 0 01-1.14-.975A14.19 14.19 0 0011.25 10.5a.75.75 0 01.75-.75zm3.239 5.183a.75.75 0 01.515.927 19.415 19.415 0 01-2.585 5.544.75.75 0 11-1.243-.84 17.912 17.912 0 002.386-5.116.75.75 0 01.927-.515z" clip-rule="evenodd" /></svg>
                  {{ $article->id }}
                </p>
                @if ($article->category_id !== null)
                  @php $category = Category::where('id', '=', $article->category_id)->get()->first(); @endphp
                  <p class="flex gap-x-3 align-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5"><path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" /></svg>
                    <a itemprop="tag" class="px-3 py-1 shadow-sm shadow-sky-300 bg-sky-500 hover:bg-sky-600 rounded-sm text-xs text-white" href="{{ action(Taxonomy\EditController::class, $category->id) }}" title="{{ __('Edit category') }}">{{ $category->name }}</a>
                  </p>
                @endif
              </div></td>
              <td class="block py-6 md:table-cell md:align-top md:w-32 md:px-6 lg:w-56">
                <time class="flex md:justify-end gap-x-4 pt-1 text-lg lg:text-base" datetime="{{ Date::parse($article->updated_at)->format('c') }}" title="{{ Date::parse($article->updated_at)->format('c') }}">
                  {{ Date::parse($article->updated_at)->format('Y/m/d \\@ H:i:s') }}
                </time>
              </td>
              <td class="block py-6 md:table-cell md:align-top md:w-32 md:px-6">
                <div class="flex gap-3">
                  <span class="status" wire:click="toggleStatePublished('{{ $article->id }}')" title="@if ($article->status->value === 'published') {{ __('Unpublish this article') }} @else {{ __('Publish this article') }} @endif">
                    {!! Status::icon($article->status) !!}
                  </span>
                  <span class="promoted" wire:click="toggleStatePromoted('{{ $article->id }}')" title="@if ($article->promoted->value === 'promoted') {{ __('Unpromote this article') }} @else {{ __('Promote this article') }} @endif">
                    {!! Promoted::icon($article->promoted) !!}
                  </span>
                </div>
                <div x-data="{
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
                  class="relative float-right mt-10"
              >
                <div class="inline-flex overflow-hidden rounded-sm divide-x divide-amber-300 border border-amber-300 shadow-md shadow-amber-50">
                  <a class="flex items-center space-x-2 px-4 py-1 bg-amber-100 hover:bg-amber-300 text-center text-sm text-amber-600 hover:text-amber-800" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit article') }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>{{ __('Edit') }}</span>
                  </a>
                  <button type="button"
                      x-ref="button"
                      x-on:click="toggle()"
                      :aria-expanded="open"
                      :aria-controls="$id('dropdown-button')"
                      class="flex items-center px-2 py-1 group bg-amber-50 hover:bg-amber-300 text-center text-sm text-secondary-700"
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
                        class="flex items-center group w-full rounded-sm px-3 py-2 divide-x divide-slate-300 space-x-3 text-gray-700 hover:bg-red-500 hover:text-white"
                    >
                      <i class="fa-solid fa-trash w-5 group-hover:text-white"></i>
                      <span class="pl-3">{{ __('Delete') }}</span>
                    </a>
                    <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Article\DestroyController::class, $article->id) }}">@csrf{{ method_field('DELETE') }}</form>
                    <a rel="external" href="{{ $permalink }}" class="flex items-center group w-full rounded-sm px-3 py-2 divide-x divide-slate-300 space-x-3 text-gray-700 hover:bg-lime-500 hover:text-white">
                      <i class="fa-solid fa-up-right-from-square w-5 group-hover:text-white"></i>
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

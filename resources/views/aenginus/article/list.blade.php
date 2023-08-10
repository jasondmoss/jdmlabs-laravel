@php
  use Aenginus\Article\Interface\Web\Controllers as Article;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Aenginus\Taxonomy\Interface\Web\Controllers as Taxonomy;
  use Carbon\Carbon;
  use Illuminate\Support\Facades\Date;
@endphp

<!-- list.blade -->
<div class="listing-wrapper flex flex-col gap-y-10">

  <header id="listingHeader" class="listing-header flex align-middle justify-between sticky mt-0">
    <h1 class="text-4xl">{{ __('Articles') }}</h1>

    <nav class="listing-tools flex items-center gap-x-10">
      <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ action(Article\CreateController::class) }}">Create New Article</a>

      <form wire:submit="search" wire:model="query" class="list-search">
        <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="form-input--text" placeholder="Search"> </label>
      </form>
    </nav>
  </header>

  <div class="listing article flex flex-col">
    @if ($articles->count())
      @foreach ($articles as $article)
        <article id="item-{{ $article->id }}" class="item grid md:grid-cols-8 gap-x-5 gap-y-3 odd:bg-white even:bg-slate-100 hover:bg-amber-50 px-2 py-10">
          <figure class="item--image md:row-start-1 md:col-start-1 md:col-span-2 md:row-span-2">
            <a href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
              @if ($article->hasMedia('signature'))
                <img src="{{ $article->getFirstMediaUrl('signature', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif
            </a>
          </figure>

          <header class="item--header md:row-start-1 md:col-start-3 md:col-span-5">
            <h3 class="title text-2xl">
              <a class="text-blue-500" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">{{ $article->title }}</a>
            </h3>
          </header>

          <p class="item--id md:row-start-2 md:col-start-3 md:col-span-3"><strong class="label">{{ __('ID') }}:</strong> {{ $article->id }}</p>

          <nav class="navigation item--taxonomy md:row-start-2 md:col-start-5 md:col-span-3 self-end py-1 flex align-bottom gap-2">
            @if ($article->category !== null)
              <i class="fa-solid fa-tag text-lg self-center mt-1"></i>
              <a itemprop="tag" class="label-category bg-amber-500 hover:bg-amber-600 text-white font-bold py-1 px-3 rounded drop-shadow-md" href="{{ action(Taxonomy\EditController::class, $article->category->id) }}" title="{{ __('Edit category') }}">{{ $article->category->name }}</a>
            @else
              <p class="w-full">
                <i class="fa-solid fa-tag text-lg self-center mt-1" style="color: var(--gray-light)"></i> &#160;
              </p>
            @endif
          </nav>

          <aside class="item--meta md:row-start-1 md:col-start-8 flex justify-end gap-4">
            <span class="status" wire:click="toggleStatePublished('{{ $article->id }}')" title="@if ($article->status->value === 'published') {{ __('Unpublish this article') }} @else {{ __('Publish this article') }} @endif">
              {!! Status::icon($article->status) !!}
            </span>
            <span class="promoted" wire:click="toggleStatePromoted('{{ $article->id }}')" title="@if ($article->promoted->value === 'promoted') {{ __('Unpromote this article') }} @else {{ __('Promote this article') }} @endif">
              {!! Promoted::icon($article->promoted) !!}
            </span>
          </aside>

          <aside class="item--date md:row-start-2 md:row-span-2 md:col-start-7 md:col-span-2 flex flex-col gap-y-3 py-2">
            <time class="created flex justify-end gap-x-4" datetime="{{ Date::parse($article->created_at)->format('c') }}" title="{{ Date::parse($article->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($article->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated flex justify-end gap-x-4" datetime="{{ Date::parse($article->updated_at)->format('c') }}" title="{{ Date::parse($article->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($article->updated_at)->format('Y/m/d') }}
            </time>
            @if ($article->published_at !== null)
              <time class="published flex justify-end gap-x-4" datetime="{{ Date::parse($article->published_at)->format('c') }}" title="{{ Date::parse($article->published_at)->format('c') }}">
                <strong class="label">{{ __('Published') }}:</strong>
                {{ Date::parse($article->published_at)->format('Y/m/d') }}
              </time>
            @else
              <span class="published flex justify-end gap-x-4">{{ __('Not Published') }}</span>
            @endif
          </aside>

          <footer class="navigation item--actions md:row-start-2 md:col-start-3 md:col-span-2 self-end py-2">
            <menu class="flex gap-4">
              <li>
                <i class="fa-solid fa-pen-to-square"></i>
                <a class="text-blue-500" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit article') }}">{{ __('Edit') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-eye" style="color: #2ec27e;"></i>
                <a rel="external" class="text-blue-500" href="{{ url('/article/' . Carbon::parse($article->published_at)->format('Y/m/d') . '/' . $article->slug) }}" title="{{ __('View article') }}">{{ __('View') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-trash"></i>
                <a class="text-blue-500" href="{{ action(Article\DestroyController::class, $article->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete article') }}">{{ __('Delete') }}</a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Article\DestroyController::class, $article->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </footer>
        </article>
      @endforeach

      {{-- Pagination. --}}
      {{ $articles->links() }}

    @else
      <div class="w-full mt-8 p-20">
        <strong>No articles found.</strong>
      </div>
    @endif
  </div>
</div>

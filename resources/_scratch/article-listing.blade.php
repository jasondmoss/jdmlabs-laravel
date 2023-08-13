<article id="item-{{ $article->id }}" class="item grid gap-x-2 gap-y-4">
  <figure class="item--image">
    <a class="block" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
      @if ($article->hasMedia('signature'))
        <img class="mx-auto" src="{{ $article->getFirstMediaUrl('signature', 'preview') }}" alt="">
      @else
        <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
      @endif
    </a>
  </figure>

  <header class="item--header">
    <h3 class="title text-2xl">
      <a class="text-blue-500" href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">{{ $article->title }}</a>
    </h3>
  </header>

  <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $article->id }}</p>

  <nav class="item--taxonomy">
    @if ($article->category !== null)
      <i class="fa-solid fa-tag text-lg self-center mt-1"></i>
      <a itemprop="tag" class="label-category bg-amber-500 hover:bg-amber-600 text-white font-bold py-1 px-3 rounded drop-shadow-md" href="{{ action(Taxonomy\EditController::class, $article->category->id) }}" title="{{ __('Edit category') }}">{{ $article->category->name }}</a>
    @else
      <p class="w-full">
        <i class="fa-solid fa-tag text-lg self-center mt-1" style="color: var(--gray-light)"></i> &#160;
      </p>
    @endif
  </nav>

  <aside class="item--meta">
    <span class="status" wire:click="toggleStatePublished('{{ $article->id }}')" title="@if ($article->status->value === 'published') {{ __('Unpublish this article') }} @else {{ __('Publish this article') }} @endif">
      {!! Status::icon($article->status) !!}
    </span>
    <span class="promoted" wire:click="toggleStatePromoted('{{ $article->id }}')" title="@if ($article->promoted->value === 'promoted') {{ __('Unpromote this article') }} @else {{ __('Promote this article') }} @endif">
      {!! Promoted::icon($article->promoted) !!}
    </span>
  </aside>

  <aside class="item--date">
    <time class="created flex md:justify-end gap-x-4" datetime="{{ Date::parse($article->created_at)->format('c') }}" title="{{ Date::parse($article->created_at)->format('c') }}">
      <strong class="label">{{ __('Created') }}:</strong>
      {{ Date::parse($article->created_at)->format('Y/m/d') }}
    </time>
    <time class="updated flex md:justify-end gap-x-4" datetime="{{ Date::parse($article->updated_at)->format('c') }}" title="{{ Date::parse($article->updated_at)->format('c') }}">
      <strong class="label">{{ __('Updated') }}:</strong>
      {{ Date::parse($article->updated_at)->format('Y/m/d') }}
    </time>
    @if ($article->published_at !== null)
      <time class="published flex md:justify-end gap-x-4" datetime="{{ Date::parse($article->published_at)->format('c') }}" title="{{ Date::parse($article->published_at)->format('c') }}">
        <strong class="label">{{ __('Published') }}:</strong>
        {{ Date::parse($article->published_at)->format('Y/m/d') }}
      </time>
    @else
      <span class="published flex justify-end gap-x-4">{{ __('Not Published') }}</span>
    @endif
  </aside>

  <footer class="item--actions">
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

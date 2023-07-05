@php
use App\Article\Application\Controllers as Article;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
@endphp
<div class="listing-wrapper">
  <nav class="listing-tools">
    <a href="{{ action(Article\CreateController::class) }}">Create New Article</a>

    <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
      <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
  </nav>
  @if ($articles->count())
    <div class="listing">
      @foreach ($articles as $article)
        <article id="item-{{ $article->id }}" class="item">

          <figure class="item--image">
            <a href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
              {{--@if ($article->hasMedia('signatures'))
                <img src="{{ $article->getFirstMediaUrl('signatures', 'thumb') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif--}}
              <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt=""></a>
          </figure>

          <header class="item--header">
            <h3 class="title">
              <a href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit') }}">{{ $article->title }}</a>
            </h3>
          </header>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $article->id }}</p>

          <nav class="item--taxonomy">
            {{--@if (count($article->categories) > 0)
              @foreach($article->categories as $category)
                {{ $loop->first ? '' : ', ' }}
                <span itemprop="tag">{{ $category->name }}</span>
              @endforeach
            @else
              <p class="w-full">&#160;</p>
            @endif--}}
            <p class="w-full">&#160;</p>
          </nav>

          <aside class="item--meta">
            <span class="status" title="{{ __('Published') }}">{!! Status::icon($article->status) !!}</span>
            <span class="promoted" title="{{ __('Promoted') }}">{!! Promoted::icon($article->promoted) !!}</span>
          </aside>

          <aside class="item--date">
            <time class="created" datetime="{{ Date::parse($article->created_at)->format('c') }}" title="{{ Date::parse($article->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($article->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($article->updated_at)->format('c') }}" title="{{ Date::parse($article->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($article->updated_at)->format('Y/m/d') }}
            </time>
          </aside>

          <footer class="navigation item--actions">
            <menu>
              <li>
                <a href="{{ action(Article\EditController::class, $article->id) }}" title="{{ __('Edit article') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              <li>
                <a rel="external" href="{{ action(Article\SingleController::class, $article->slug) }}" title="{{ __('View article') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li>
              <li>
                <a href="{{ action(Article\DestroyController::class, $article->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete article') }}">
                  <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                </a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Article\DestroyController::class, $article->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </footer>

        </article>
      @endforeach
    </div>
    {{-- Pagination. --}}
    {{ $articles->links() }}
  @else
    <div class="w-full mt-8 p-20">
      <strong>No articles found.</strong>
    </div>
  @endif
</div>

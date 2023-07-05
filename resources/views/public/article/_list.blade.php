@php
use App\Article\Application\Controllers as Article;
@endphp
@if ($articles->count())
  <div class="listings article">
    @foreach ($articles as $article)
      <article itemid="{{ action(Article\PublishedController::class, $article->id) }}" itemscope itemtype="https://schema.org/" id="article_{{ $article->id }}" class="h-entry h-as-article card">
        {{--@if ($article->hasMedia('signatures'))
          <figure class="entry-image">
            <img src="{{ $article->getFirstMediaUrl('signatures', 'preview') }}" alt="">
          </figure>
        @endif--}}
        <header class="entry-header">
          <time itemprop="datePublished" datetime="{{ date('c', strtotime($article->created_at)) }}" class="dt-published">{{ date('F jS, Y', strtotime($article->created_at)) }}</time>
          <h3><a href="{{ action(Article\SingleController::class, $article->slug) }}">{{ $article->title }}</a></h3>
          <nav class="taxonomy">
            {{--@foreach($article->categories as $category)
              {{ $loop->first ? '' : ', ' }}
              <a itemprop="tag" href="/articles/topic/{{ $category->slug }}">{{ $category->name }}</a>
            @endforeach--}}
          </nav>
        </header>
        <div class="entry-summary">
          {!! $article->summary !!}
        </div>
        <footer>
          @if (@auth()->check())
            <a rel="nofollow" class="button" href="{{ action(Article\EditController::class, $article->id) }}">{{ __('Edit') }}</a>
          @endif
        </footer>
      </article>

    @endforeach
  </div>
  {{-- Pagination. --}}
  {{ $articles->links() }}
@else
  <div class="">
    <strong>No matches found.</strong>
  </div>
@endif

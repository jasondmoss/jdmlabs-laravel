@php
  use Carbon\Carbon;
@endphp

<x-public.layout title="Articles" page="index" schema="WebPage" type="page listing" livewire="true">
  <header class="">
    <h1 class="">{{ __('Articles') }}</h1>
  </header>

  <div itemscope itemtype="http://schema.org/Blog" class="listings article">
    @if ($articles->count())
      @foreach ($articles as $article)
        <article itemscope itemtype="https://schema.org/Article" itemid="{{ url('/article/' . $article->slug) }}" id="{{ $article->id }}" class="h-entry h-as-article card">
          <figure class="item--image">
            <a href="{{ $article->permalink }}" title="{{ __('View article') }}">
              @if ($article->hasMedia('signatures'))
                <img src="{{ $article->getFirstMediaUrl('signatures', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif
            </a>
          </figure>
          <header class="entry-header">
            <time itemprop="datePublished" datetime="{{ date('c', strtotime($article->created_at)) }}" class="dt-published">{{ date('F jS, Y', strtotime($article->created_at)) }}</time>
            <h3>
              <a href="{{ $article->permalink }}">{{ $article->title }}</a>
            </h3>
            @if (! is_null($article->category))
              <nav class="navigation taxonomy">
                <i class="fa-solid fa-tag" sttyle="color:#f00"></i>
                <a itemprop="tag" class="label-category" href="#" title="{{ __('') }}">{{ $article->category->name }}</a>
              </nav>
            @endif
          </header>
          <div class="entry-summary">
            {!! $article->summary !!}
          </div>
          <footer>
            @if (@auth()->check())
              <a rel="nofollow" class="button" href="{{ action(\App\Article\Interface\Web\Controllers\EditController::class, $article->id) }}">{{ __('Edit') }}</a>
            @endif
          </footer>
        </article>

        @if ($loop->first)
          {{ dump($article) }}
        @endif
      @endforeach
    @else
      <div class="">
        <strong>No matches found.</strong>
      </div>
    @endif
  </div>
</x-public.layout>

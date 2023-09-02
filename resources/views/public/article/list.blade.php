<?php
  use Aenginus\Article\Interface\Web\Controllers as Article;
?>
<x-public.layout
  schema="CollectionPage"
  title="Articles"
  page=" article"
  context=" listing"
  livewire="true"
>
  <x-shared.session/>

  <header class="">
    <h1 class="">{{ __('Articles') }}</h1>
  </header>

  <div itemscope itemtype="https://schema.org/Blog" class="listings">

    @if ($articles->count() > 0)
      @foreach ($articles as $article)
        {{--@if ($loop->first)
          {{ dump($article) }}
        @endif--}}

        <article itemscope itemtype="https://schema.org/Article" itemid="{{ url('/article/' . $article->slug) }}" id="{{ $article->id }}" class="h-entry h-as-article">
          <figure class="entry--image">
            <a href="{{ $article->permalink }}" title="{{ __('View article') }}">
              <img src="{{ $article->getFirstMediaUrl('signature', 'preview') }}" alt="">
            </a>
          </figure>
          <header class="entry--header">
            <time itemprop="datePublished" datetime="{{ date('c', strtotime($article->created_at)) }}" class="dt-published">{{ date('F jS, Y', strtotime($article->created_at)) }}</time>
            <h3>
              <a href="{{ $article->permalink }}">{{ $article->title }}</a>
            </h3>
            @if ($article->category !== null)
              <nav class="nav--taxonomy">
                <i class="fa-solid fa-tag" sttyle="color:#f00"></i>
                <a itemprop="tag" href="#" title="{{ __('') }}">{{ $article->category->name }}</a>
              </nav>
            @endif
          </header>
          <div class="entry--summary">
            {!! $article->summary !!}
          </div>
          <footer class="entry--footer">
            @if (@auth()->check())
              <a rel="nofollow" class="button" href="{{ action(Article\EditController::class, $article->id) }}">{{ __('Edit') }}</a>
            @endif
          </footer>
        </article>
      @endforeach
    @else
      <div class="">
        <strong>No matches found.</strong>
      </div>
    @endif

  </div>
</x-public.layout>

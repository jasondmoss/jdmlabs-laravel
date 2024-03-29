<?php
  use Aenginus\Article\Interface\Web\Controllers as Article;
?>
<x-public.layout
  schema="CollectionPage"
  title="Articles"
  page="article"
  context="listing"
  livewire="true"
>
  <x-shared.session/>

  <header>
    <h1 class="">{{ __('Articles') }}</h1>
  </header>

  <div itemscope itemtype="https://schema.org/Blog">

  @if ($articles->count() > 0)
    @foreach ($articles as $article)
    <article itemid="{{ $article->permalink }}" itemscope itemtype="https://schema.org/Article" id="{{ $article->id }}" class="h-entry h-as-article">
      @if ($article->signature !== null)
        <figure itemscope itemtype="https://schema.org/ImageObject" role="group">
          <a href="{{ $article->permalink }}" title="{{ __('View article') }}">
            <x-shared.media.thumbnail :model="$article" :image="$article->signature" />
          </a>
        </figure>
      @endif
      <header>
        @if ($article->category !== null)
        <nav>
          <i class="fa-solid fa-tag" sttyle="color:#f00"></i>
          <a itemprop="tag" href="#" title="{{ __('') }}">{{ $article->category->name }}</a>
        </nav>
        @endif

        <h3><a href="{{ $article->permalink }}">{{ $article->title }}</a></h3>
      </header>
      <footer>
        <time itemprop="datePublished" datetime="{{ $article->date->published->iso }}" class="dt-published">{{ $article->date->published->display }}</time>
        <time itemprop="dateUpdate" datetime="{{ $article->date->updated->iso }}" class="dt-updated srt">{{ $article->date->updated->display }}</time>

        @if (@auth()->check())
          <a rel="nofollow" href="{{ action(Article\EditController::class, $article->id) }}" title="{!! __('Edit article') !!}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
            </svg>
            <span class="srt">{{ __('Edit') }}</span>
          </a>
        @endif
      </footer>
    </article>
    @endforeach
  @else
    <div>
      <strong>No matches found.</strong>
    </div>
  @endif

  </div>
</x-public.layout>

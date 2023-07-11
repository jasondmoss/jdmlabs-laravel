<x-public.layout title="{{ $article->title }}" page="show" schema="ItemPage" type="page single" livewire="true">
  <header>
    {{--@if ($article->hasMedia('signatures'))
      {{ $article->getFirstMedia('signatures') }}
    @endif--}}
    <h1>{{ $article->title }}</h1>
    <time>{{ Date::createFromFormat('Y-m-d H:i:s', $article->created_at)->format('d M Y') }}</time>
    @if (! is_null($article->category))
      <nav class="">
        <a itemprop="tag" href="/articles/topic/{{ $article->category->slug }}">{{ $article->category->name }}</a>
      </nav>
    @endif
  </header>
  <div class="">
    <p class="">{!! $article->body !!}</p>
  </div>
</x-public.layout>

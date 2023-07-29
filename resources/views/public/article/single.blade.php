<x-public.layout title="{{ $article->title }}" page="show" schema="ItemPage" type="page single" livewire="true">
  <header>
    {{ $signature }}
    <h1>{{ $article->title }}</h1>
    <time>{{ Date::createFromFormat('Y-m-d H:i:s', $article->created_at)->format('d M Y') }}</time>
    @if (! is_null($article->category))
      <p class="">
        <span>{{ __('Filed under') }}:</span>
        <a itemprop="tag" href="/articles/category/{{ $article->category->slug }}">{{ $article->category->name }}</a>
      </p>
    @endif
  </header>
  <div class="">
    <p class="">{!! $article->body !!}</p>
  </div>
</x-public.layout>

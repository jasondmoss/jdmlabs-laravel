<x-public.layout title="{{ $article->title }}" page="show" schema="ItemPage" type="page single" livewire="true">
  <header>
    {{--@if ($article->hasMedia('signatures'))
      {{ $article->getFirstMedia('signatures') }}
    @endif--}}
    <h1>{{ $article->title }}</h1>
    <time>{{ Date::createFromFormat('Y-m-d H:i:s', $article->created_at)->format('d M Y') }}</time>
    {{--@if ($article->categories)
      <nav class="">
        @foreach($article->categories as $category)
          {{ $loop->first ? '' : ', ' }}
          <a itemprop="tag" href="/articles/topic/{{ $category->slug }}">{{ $category->name }}</a>
        @endforeach
      </nav>
    @endif--}}
  </header>
  <div class="">
    <p class="">{!! $article->body !!}</p>
  </div>
</x-public.layout>

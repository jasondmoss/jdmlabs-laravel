<x-public.layout
  schema="ItemPage"
  title="{{ $article->title }}"
  page=" article"
  context=" detail"
  livewire="true"
>
  <article itemscope itemtype="https://schema.org/Article" itemid="{{ url('/article/' . $article->slug) }}" id="{{ $article->id }}" class="h-entry h-as-article card">
    <header class="entry--header">
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
    <div class="entry--content">
      <p class="">{!! $article->body !!}</p>
    </div>
    <footer class="entry--footer"></footer>
  </article>

  {{ dump($article) }}

</x-public.layout>

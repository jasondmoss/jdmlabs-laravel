@php
@endphp
<article class="">
  <img class="" src="" alt="Placeholder">
  <div class="">
    <h2 class="">
      <a href="{{ action(\Aenginus\Article\Interface\Web\Controllers\SingleController::class, $article->slug) }}">
        {{ $article->title }}
      </a>
    </h2>
    <div class="">
      {!! $article->summary !!}
    </div>
  </div>
</article>

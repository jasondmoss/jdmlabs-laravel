@php
  use App\Article\Application\Controllers\ArticlePublicShowController;
@endphp
<article class="">
  <img class="" src="https://cdn.pixabay.com/photo/2022/01/08/14/53/town-6924142_960_720.jpg" alt="Placeholder">
  <div class="">
    <h2 class="">
      <a href="{{ action(ArticlePublicShowController::class, $article->slug) }}">
        {{ $article->title }}
      </a>
    </h2>
    <div class="">
      {!! $article->summary !!}
    </div>
  </div>
</article>
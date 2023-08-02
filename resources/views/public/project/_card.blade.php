@php
  use App\Project\Application\Controllers;
@endphp
<article class="">
  {{--<img class="" src="@if ($project->image) {{ Storage::url($project->image->url) }} @else https://cdn.pixabay.com/photo/2022/01/08/14/53/town-6924142_960_720.jpg @endif" alt="">--}}
  <div class="">
    <h2 class="">
      <a href="{{ action(\App\Project\Interface\Web\Controllers\SingleController::class, $project->slug) }}">
        {{ $project->title }}
      </a>
    </h2>
    <div class="">
      {!! $project->summary !!}
    </div>
  </div>
</article>

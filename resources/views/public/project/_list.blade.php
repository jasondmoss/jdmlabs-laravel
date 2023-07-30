@php
@endphp
@if ($projects->count())
  @foreach ($projects as $project)
    <article class="">
      {{--@if ($project->hasMedia('signatures'))
        <figure class="entry-image">
          <img src="{{ $project->getFirstMediaUrl('signatures', 'preview') }}" alt="">
        </figure>
      @endif--}}
      <header>
        <h3 class="">
          <a href="{{ action(\App\Project\Interface\Http\Controllers\SingleController::class, $project->slug) }}">{{ $project->title }}</a>
        </h3>
        <nav class="taxonomy">
          {{--@foreach($project->categories as $category)
            {{ $loop->first ? '' : ', ' }}
            <a itemprop="tag" href="/projects/category/{{ $category->slug }}">{{ $category->name }}</a>
          @endforeach--}}
        </nav>
      </header>
      <div class="entry-summary">
        {!! $project->summary !!}
      </div>
      <footer>
        @if (@auth()->check())
          <a rel="nofollow" class="button" href="{{ action(\App\Project\Interface\Http\Controllers\EditController::class, $project->id) }}">{{ __('Edit') }}</a>
        @endif
      </footer>
    </article>

  @endforeach
@else
  <div class="">
    <strong>No matches found.</strong>
  </div>
@endif

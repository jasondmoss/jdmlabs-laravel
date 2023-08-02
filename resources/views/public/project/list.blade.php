@php
  @endphp
@foreach ($projects as $project)
  @if ($loop->first)
    {{ dd($project) }}
  @endif

  <article class="">
    <figure class="item--image">
      <a href="{{ action(\App\Project\Interface\Http\Web\Controllers\SingleController::class, $project->slug) }}" title="{{ __('View project') }}">
        @if ($project->hasMedia('signatures'))
          <img src="{{ $project->getFirstMediaUrl('signatures', 'preview') }}" alt="">
        @else
          <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
        @endif
      </a>
    </figure>
    <header>
      <h3 class="">
        <a href="{{ action(\App\Project\Interface\Http\Web\Controllers\SingleController::class, $project->slug) }}">{{ $project->title }}</a>
      </h3>
      @if (! is_null($project->category))
        <nav class="navigation taxonomy">
          <i class="fa-solid fa-tag"></i>
          <a itemprop="tag" class="label-category" href="#" title="{{ __('') }}">{{ $project->category->name }}</a>
        </nav>
      @endif
    </header>
    <div class="entry-summary">
      {!! $project->summary !!}
    </div>
    <footer>
      @if (@auth()->check())
        <a rel="nofollow" class="button" href="{{ action(\App\Project\Interface\Http\Web\Controllers\EditController::class, $project->id) }}">{{ __('Edit') }}</a>
      @endif
    </footer>
  </article>

@endforeach

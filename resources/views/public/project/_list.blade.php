@php
	use App\Project\Application\Controllers;
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
					<a href="{{ action(Controllers\ProjectPublicShowController::class, $project->slug) }}">{{ $project->title }}</a>
				</h3>
				<nav class="taxonomy">
					{{--@foreach($project->categories as $category)
						{{ $loop->first ? '' : ', ' }}
						<a itemprop="tag" href="/projects/topic/{{ $category->slug }}">{{ $category->name }}</a>
					@endforeach--}}
				</nav>
			</header>
			<div class="">
				{!! $project->summary !!}
			</div>
		</article>

	@endforeach
@else
	<div class="">
		<strong>No matches found.</strong>
	</div>
@endif

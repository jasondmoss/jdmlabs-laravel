@php
	use App\Project\Application\Controllers;
@endphp
<x-public.layout title="{{ $client->title }}" page="show" schema="ItemPage" type="page detail" livewire="true">
	<header>
		{{--<img src="{{ $client->getImageCard() }}" alt="">--}}
		<h1>{{ $client->name }}</h1>
		<p><a rel="external" href="{{ $client->website }}">{{ $client->website }}</a></p>
	</header>
	<div class="">
		<p class="">{!! $client->summary !!}</p>
	</div>
	<div class="">
		<h2>{{ __('Projects')  }}</h2>
		@if ($client->projects)
			@foreach ($client->projects as $project)
				<p class="">
					<a href="{{ action(Controllers\ProjectPublicShowController::class, $project->slug) }}">{{ $project->title }}</a>
				</p>
			@endforeach
		@endif
	</div>
</x-public.layout>
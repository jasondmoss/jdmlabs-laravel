@php
  use Aenginus\Client\Interface\Web\Controllers as Client;
  use Aenginus\Project\Interface\Web\Controllers as  Project;
  use Aenginus\Shared\Enums\Pinned;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Aenginus\Taxonomy\Interface\Web\Controllers as Taxonomy;
  use Illuminate\Support\Facades\Date;
@endphp

<!-- list.blade -->
<div class="listing-wrapper flex flex-col gap-y-10">

  <header id="listingHeader" class="listing-header flex align-middle justify-between sticky mt-2">
    <h1 class="text-4xl">{{ __('Projects') }}</h1>

    <nav class="listing-tools flex items-center gap-x-10">
      <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ action(Project\CreateController::class) }}">Create New Project</a>

      <form wire:submit="search" wire:model="query" class="list-search">
        <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="form-input--text" placeholder="Search"> </label>
      </form>
    </nav>
  </header>

  @if ($projects->count())
    <div class="listing project flex flex-col">
      @foreach ($projects as $project)
        <article id="item-{{ $project->id }}" class="item grid md:grid-cols-8 gap-x-5 gap-y-3 odd:bg-white even:bg-slate-100 hover:bg-amber-50 px-2 py-10">

          <figure class="item--image md:row-start-1 md:col-start-1 md:col-span-2 md:row-span-4">
            <a href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">
              @if ($project->hasMedia('signature'))
                <img src="{{ $project->getFirstMediaUrl('signature', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif
            </a>
          </figure>

          <header class="item--header md:row-start-1 md:row-span-2 md:col-start-3 md:col-span-5">
            <h3 class="title text-2xl">
              <a class="text-blue-500 hover:text-blue-700 hover:underline" href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">{{ $project->title }}</a>
            </h3>
            <p class="subtitle">
              <a class="hover:text-red-700 hover:underline" href="{{ action(Client\EditController::class, $project->clients->id) }}" title="{{ __('Edit Client') }}">{{ $project->clients->name }}</a>
            </p>
          </header>

          <p class="item--id md:row-start-3 md:col-start-3 md:col-span-4"><strong class="label">{{ __('ID') }}:</strong> {{ $project->id }}</p>

          <nav class="navigation item--taxonomy md:row-start-4 md:col-start-5 md:col-span-3 self-end py-1 flex align-bottom gap-2">
            @if ($project->category !== null)
              <i class="fa-solid fa-tag text-lg self-center mt-1"></i>
              <a itemprop="tag" class="label-category bg-amber-500 hover:bg-amber-600 text-white font-bold py-1 px-3 rounded drop-shadow-md" href="{{ action(Taxonomy\EditController::class, $project->category->id) }}" title="{{ __('Edit category') }}">{{ $project->category->name }}</a>
            @else
              <p class="w-full">
                <i class="fa-solid fa-tag text-lg self-center mt-1" style="color: var(--gray-light)"></i> &#160;
              </p>
            @endif
          </nav>

          <aside class="item--meta md:row-start-1 md:col-start-7 md:col-span-2 justify-end flex gap-4">
            <span class="status" wire:click="toggleStatePublished('{{ $project->id }}')" title="@if ($project->status->value === 'published') {{ __('Unpublish this project') }} @else {{ __('Publish this project') }} @endif">
              {!! Status::icon($project->status) !!}
            </span>
            <span class="promoted" wire:click="toggleStatePromoted('{{ $project->id }}')" title="@if ($project->promoted->value === 'promoted') {{ __('Unpromote this project') }} @else {{ __('Promote this project') }} @endif">
              {!! Promoted::icon($project->promoted) !!}
            </span>
            <span class="pinned" wire:click="toggleStatePinned('{{ $project->id }}')" title="@if ($project->pinned->value === 'pinned') {{ __('Unpin this project') }} @else {{ __('Pin this project') }} @endif">
              {!! Pinned::icon($project->pinned) !!}
            </span>
          </aside>

          <aside class="item--date md:row-start-2 md:row-span-3 md:col-start-7 md:col-span-2 flex flex-col gap-y-3 self-end py-2">
            <time class="created flex justify-end gap-x-4" datetime="{{ Date::parse($project->created_at)->format('c') }}" title="{{ Date::parse($project->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($project->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated flex justify-end gap-x-4" datetime="{{ Date::parse($project->updated_at)->format('c') }}" title="{{ Date::parse($project->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($project->updated_at)->format('Y/m/d') }}
            </time>
            @if ($project->published_at !== null)
              <time class="published flex justify-end gap-x-4" datetime="{{ Date::parse($project->published_at)->format('c') }}" title="{{ Date::parse($project->published_at)->format('c') }}">
                <strong class="label">{{ __('Published') }}:</strong>
                {{ Date::parse($project->published_at)->format('Y/m/d') }}
              </time>
            @else
              <span class="published flex justify-end gap-x-4">{{ __('Not Published') }}</span>
            @endif
          </aside>

          <footer class="navigation item--actions md:row-start-4 md:col-start-3 md:col-span-2 self-end py-2">
            <menu class="flex gap-4">
              <li>
                <a class="text-blue-500 hover:text-blue-700 hover:underline" href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit project') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              <li>
                <a rel="external" class="text-blue-500 hover:text-blue-700 hover:underline" href="{{ action(Project\SingleController::class, $project->slug) }}" title="{{ __('View project') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li>
              <li>
                <a class="text-blue-500 hover:text-blue-700 hover:underline" href="{{ action(Project\DestroyController::class, $project->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete project') }}">
                  <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                </a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Project\DestroyController::class, $project->id) }}">@csrf {{ method_field('DELETE') }}</form>
              </li>
            </menu>
          </footer>
        </article>

      @endforeach
    </div>
    {{-- Pagination. --}}
    {{ $projects->links() }}
  @else
    <div class="w-full mt-8 p-20">
      <strong>No projects found.</strong>
    </div>
  @endif
</div>

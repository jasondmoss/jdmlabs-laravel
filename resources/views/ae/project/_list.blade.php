@php
  use App\Client\Application\Controllers\ClientAdminEditController;use App\Project\Application\Controllers;use App\Project\Application\Controllers\Admin;use App\Shared\Domain\Enums\Pinned;use App\Shared\Domain\Enums\Promoted;use App\Shared\Domain\Enums\Status;
@endphp
<div class="listing-wrapper">
  <nav class="listing-tools">
    <a href="{{ action(Controllers\ProjectAdminCreateController::class) }}">Create New Project</a>

    <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
      <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
  </nav>
  @if ($projects->count())
    <div class="listing">
      @foreach ($projects as $project)
        <article id="item-{{ $project->id }}" class="item">

          <figure class="item--image">
            <a href="{{ action(Controllers\ProjectAdminEditController::class, $project->id) }}" title="{{ __('Edit') }}">
              {{--@if ($project->hasMedia('signatures'))
                <img src="{{ $project->getFirstMediaUrl('signatures', 'thumb') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif--}}
              <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt=""></a>
          </figure>

          <header class="item--header">
            <h3 class="title">
              <a href="{{ action(Controllers\ProjectAdminEditController::class, $project->id) }}" title="{{ __('Edit') }}">{{ $project->title }}</a>
            </h3>
            <p class="subtitle">
              <a href="{{ action(ClientAdminEditController::class, $project->clients->id) }}" title="{{ __('Edit Client') }}">{{ $project->clients->name }}</a>
            </p>
          </header>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $project->id }}</p>

          <nav class="item--taxonomy">
            {{--@if (count($project->categories) > 0)
              @foreach($project->categories as $category)
                {{ $loop->first ? '' : ', ' }}
                <span itemprop="tag">{{ $category->name }}</span>
              @endforeach
            @else
              <p class="w-full">&#160;</p>
            @endif--}}
            <p class="w-full">&#160;</p>
          </nav>

          <aside class="item--meta">
            <span class="status" title="{{ __('Published') }}">{!! Status::icon($project->status) !!}</span>
            <span class="promoted" title="{{ __('Promoted') }}">{!! Promoted::icon($project->promoted) !!}</span>
            <span class="promoted" title="{{ __('Pinned') }}">{!! Pinned::icon($project->pinned) !!}</span>
          </aside>

          <aside class="item--date">
            <time class="created" datetime="{{ Date::parse($project->created_at)->format('c') }}" title="{{ Date::parse($project->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($project->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($project->updated_at)->format('c') }}" title="{{ Date::parse($project->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($project->updated_at)->format('Y/m/d') }}
            </time>
          </aside>

          <footer class="navigation item--actions">
            <menu>
              <li>
                <a href="{{ action(Controllers\ProjectAdminEditController::class, $project->id) }}" title="{{ __('Edit project') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              <li>
                <a rel="external" href="{{ action(Controllers\ProjectPublicShowController::class, $project->slug) }}" title="{{ __('View project') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li>
              <li>
                <a href="{{ action(Controllers\ProjectAdminDestroyController::class, $project->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete project') }}">
                  <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                </a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Controllers\ProjectAdminDestroyController::class, $project->id) }}">@csrf {{ method_field('DELETE') }}</form>
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
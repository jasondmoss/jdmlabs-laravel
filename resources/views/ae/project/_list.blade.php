@php
use App\Client\Application\Controllers as Client;
use App\Project\Application\Controllers as Project;
use App\Shared\Domain\Enums\Pinned;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
@endphp

@push('styles')
  @once
<style>
.item {
  grid-template-columns: 1fr;
}

.item--image {
  grid-row: 4;
}

.item--header {
  grid-row: 1;
}

.item--header .subtitle {
  margin-top: 0.5rem;
  margin-bottom: 0;
}

.item--id {
  grid-row: 2;
}

.item--meta {
  grid-row: 3;
}

@media screen {
  @media (max-width: 39.9375rem) {
    .item {
      gap: 1rem;
    }
  }

  @media (min-width: 40rem) {
    .item {
      grid-template-columns: 10rem 1fr;
    }

    .item--image {
      grid-column: 1;
      grid-row: 1/span 3;
    }

    .item--header,
    .item--id,
    .item--taxonomy,
    .item--actions,
    .item--date {
      grid-column: 2;
    }

    .item--meta {
      grid-column: 1;
      grid-row: 4;
    }

    .item--actions menu {
      justify-content: flex-start;
    }
  }

  @media (min-width: 40rem) and (max-width: 59.9375rem) {
    .item--meta {
      margin-top: 2rem;
    }
  }

  @media (min-width: 60rem) {
    .item {
      grid-template-columns: 10rem 1fr 12rem;
    }

    .item--header {
      grid-row: 1/span 3;
    }

    .item--id {
      grid-row: 3;
      align-self: center;
      margin-top: 0.5rem;
    }

    .item--taxonomy {
      grid-row: 3;
      align-self: end;
      margin-top: 1rem;
    }

    .item--meta {
      grid-column: 3;
      grid-row: 1;
      justify-content: flex-start;
    }

    .item--meta svg {
      width: 1.5rem;
      height: 1.5rem;
    }

    .item--date {
      grid-column: 3;
      grid-row: 2/span 2;
    }

    .item--actions {
      align-self: end;
    }

    .item--actions menu {
      justify-content: end;
      padding-right: 3rem;
    }
  }

  @media (min-width: 75rem) {
    .item {
      gap: 0 2rem;
    }
  }
}
</style>
  @endonce
@endpush

<div class="listing-wrapper">
  <nav class="listing-tools">
    <a class="button create-new" href="{{ action(Project\CreateController::class) }}">Create New Project</a>

    <div class="list-search">
      <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
        <input wire:model="search" class="form-input--text" placeholder="Search">
      </label>
    </div>
  </nav>
  @if ($projects->count())
    <div class="listing project">
      @foreach ($projects as $project)
        <article id="item-{{ $project->id }}" class="item">

          <figure class="item--image">
            <a href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">
              {{--@if ($project->hasMedia('signatures'))
                <img src="{{ $project->getFirstMediaUrl('signatures', 'thumb') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif--}}
              <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt=""></a>
          </figure>

          <header class="item--header">
            <h3 class="title">
              <a href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">{{ $project->title }}</a>
            </h3>
            <p class="subtitle">
              <a href="{{ action(Client\EditController::class, $project->clients->id) }}" title="{{ __('Edit Client') }}">{{ $project->clients->name }}</a>
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
                <a href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit project') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              <li>
                <a rel="external" href="{{ action(Project\SingleController::class, $project->slug) }}" title="{{ __('View project') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li>
              <li>
                <a href="{{ action(Project\DestroyController::class, $project->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete project') }}">
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

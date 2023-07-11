@php
  use App\Taxonomy\Category\Application\Controllers;
@endphp
<div class="listing-wrapper">
  <nav class="listing-tools">
    <a href="{{ action(Controllers\CreateController::class) }}">Create New Category</a>

    <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
      <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
  </nav>
  @if ($categories->count())
    <ul class="listing">
      @foreach ($categories as $cat)
        <li id="item-{{ $cat->id }}" class="item">
          <div class="item--header">
            <h3 class="title">
              <a href="{{ action(Controllers\EditController::class, $cat->id) }}" title="{{ __('Edit') }}">{{ $cat->name }}</a>
            </h3>
          </div>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $cat->id }}</p>

          <div class="item--date">
            <time class="created" datetime="{{ Date::parse($cat->created_at)->format('c') }}" title="{{ Date::parse($cat->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($cat->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($cat->updated_at)->format('c') }}" title="{{ Date::parse($cat->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($cat->updated_at)->format('Y/m/d') }}
            </time>
          </div>

          <div class="navigation item--actions">
            <menu>
              <li>
                <a href="{{ action(Controllers\EditController::class, $cat->id) }}" title="{{ __('Edit article') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              <li>
                <a rel="external" href="{{ action(Controllers\SingleController::class, $cat->slug) }}" title="{{ __('View article') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li>
              <li>
                <a href="{{ action(Controllers\DestroyController::class, $cat->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete article') }}">
                  <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                </a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Controllers\DestroyController::class, $cat->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</div>

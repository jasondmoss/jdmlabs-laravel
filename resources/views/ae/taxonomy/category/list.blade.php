@php
  use App\Taxonomy\Application\Controllers;
@endphp

@push('styles')
  @once
    <style>
			.listing-wrapper {
				max-width: 50rem;
			}

			.listing-wrapper .listing {
				/*flex-flow: row wrap;*/
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(16rem, 1fr));
				gap: 0 1rem;
			}

			.item {
				/*grid-template-columns: 1fr;*/
				display: flex;
				flex-direction: column;
				gap: 0.5rem 0;
				width: auto;
			}

			.item--actions menu {
				justify-content: flex-start;
			}

			@media screen and (min-width: 40rem) {
				.item {
					grid-template-columns: 1fr 12rem;
					gap: 0.5rem 1rem;
				}

				.item--header,
				.item--id,
				.item--actions {
					grid-column: 1;
				}

				.item--count {
					grid-column: 2;
					grid-row: 1;
					list-style: none;
					font-size: 0.9rem;
				}

				.item--date {
					grid-column: 2;
					grid-row: 2/span 2;
				}
			}
    </style>
  @endonce
@endpush

<div class="listing-wrapper">
  <nav class="listing-tools">
    <a class="button create-new" href="{{ action(\App\Taxonomy\Interface\Http\Controllers\CreateController::class) }}">Create New Category</a>

    <div class="list-search">
      <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
        <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
    </div>
  </nav>
  @if ($categories->count())
    <ul class="listing taxonomy category">
      @foreach ($categories as $cat)
        <li id="item-{{ $cat->id }}" class="item">
          <div class="item--header">
            <h3 class="title">
              <a href="{{ action(\App\Taxonomy\Interface\Http\Controllers\EditController::class, $cat->id) }}" title="{{ __('Edit') }}">{{ $cat->name }}</a>
            </h3>
          </div>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $cat->id }}</p>

          <ul class="item--count" style="color: #007741;">
            <li class="article"><strong class="label">{{ __('Articles') }}:</strong> {{ $cat->articles_count }}</li>
          </ul>

          {{-- <div class="item--date">
            <time class="created" datetime="{{ Date::parse($cat->created_at)->format('c') }}" title="{{ Date::parse($cat->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($cat->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($cat->updated_at)->format('c') }}" title="{{ Date::parse($cat->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($cat->updated_at)->format('Y/m/d') }}
            </time>
          </div> --}}

          <div class="navigation item--actions">
            <menu>
              <li>
                <a href="{{ action(\App\Taxonomy\Interface\Http\Controllers\EditController::class, $cat->id) }}" title="{{ __('Edit article') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              {{-- <li>
                <a rel="external" href="{{ action(Controllers\SingleController::class, $cat->slug) }}" title="{{ __('View article') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li> --}}
              <li>
                <a href="{{ action(\App\Taxonomy\Interface\Http\Controllers\DestroyController::class, $cat->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete article') }}">
                  <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                </a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(\App\Taxonomy\Interface\Http\Controllers\DestroyController::class, $cat->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </div>
        </li>
      @endforeach
    </ul>

    {{-- Pagination. --}}
    {{ $categories->links() }}

  @endif
</div>

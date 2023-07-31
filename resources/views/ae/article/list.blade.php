@php
  use App\Core\Shared\Enums\Promoted;use App\Core\Shared\Enums\Status;use Illuminate\Support\Facades\Date;
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

			.item--id {
				grid-row: 2;
			}

			.item--meta {
				grid-row: 3;
			}

			.item--meta .status,
			.item--meta .promoted {
				cursor: pointer;
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
						grid-template-columns: 10rem 1fr 14rem;
					}

					.item--header {
						grid-row: 1/span 2;
					}

					.item--id {
						margin-top: 0.5rem;
					}

					.item--taxonomy {
						grid-row: 2;
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
    <a class="button create-new" href="{{ action(\App\Article\Interface\Http\Controllers\CreateController::class) }}">Create New Article</a>

    <div class="list-search">
      <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
        <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
    </div>
  </nav>

  @if ($articles->count())
    <div class="listing article">
      @foreach ($articles as $article)
        <article id="item-{{ $article->id }}" class="item">
          <figure class="item--image">
            <a href="{{ action(\App\Article\Interface\Http\Controllers\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
              @if ($article->hasMedia('signatures'))
                <img src="{{ $article->getFirstMediaUrl('signatures', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
            @endif
          </figure>

          <header class="item--header">
            <h3 class="title">
              <a href="{{ action(\App\Article\Interface\Http\Controllers\EditController::class, $article->id) }}" title="{{ __('Edit') }}">{{ $article->title }}</a>
            </h3>
          </header>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $article->id }}</p>

          <nav class="navigation item--taxonomy">
            @if (! is_null($article->category))
              <i class="fa-solid fa-tag"></i>
              <a itemprop="tag" class="label-category" href="{{ action(\App\Taxonomy\Interface\Http\Controllers\EditController::class, $article->category->id) }}" title="{{ __('Edit category') }}">{{ $article->category->name }}</a>
            @else
              <p class="w-full">
                <i class="fa-solid fa-tag" style="color: var(--gray-light)"></i> &#160;
              </p>
            @endif
          </nav>

          <aside class="item--meta">
            <span class="status" wire:click="toggleStatePublished('{{ $article->id }}')" title="@if ('published' === $article->status->value) {{ __('Unpublish this article') }} @else {{ __('Publish this article') }} @endif">
              {!! Status::icon($article->status) !!}
            </span>
            <span class="promoted" wire:click="toggleStatePromoted('{{ $article->id }}')" title="@if ('promoted' === $article->promoted->value) {{ __('Unpromote this article') }} @else {{ __('Promote this article') }} @endif">
              {!! Promoted::icon($article->promoted) !!}
            </span>
          </aside>

          <aside class="item--date">
            <time class="created" datetime="{{ Date::parse($article->created_at)->format('c') }}" title="{{ Date::parse($article->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($article->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($article->updated_at)->format('c') }}" title="{{ Date::parse($article->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($article->updated_at)->format('Y/m/d') }}
            </time>
            @if (! is_null($article->published_at))
              <time class="published" datetime="{{ Date::parse($article->published_at)->format('c') }}" title="{{ Date::parse($article->published_at)->format('c') }}">
                <strong class="label">{{ __('Published') }}:</strong>
                {{ Date::parse($article->published_at)->format('Y/m/d') }}
              </time>
            @else
              <span class="published">{{ __('Not Published') }}</span>
            @endif
          </aside>

          <footer class="navigation item--actions">
            <menu>
              <li>
                <i class="fa-solid fa-pen-to-square"></i>
                <a href="{{ action(\App\Article\Interface\Http\Controllers\EditController::class, $article->id) }}" title="{{ __('Edit article') }}">{{ __('Edit') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-eye" style="color: #2ec27e;"></i>
                <a rel="external" href="{{ action(\App\Article\Interface\Http\Controllers\SingleController::class, $article->slug) }}" title="{{ __('View article') }}">{{ __('View') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-trash"></i>
                <a href="{{ action(\App\Article\Interface\Http\Controllers\DestroyController::class, $article->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete article') }}">{{ __('Delete') }}</a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(\App\Article\Interface\Http\Controllers\DestroyController::class, $article->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </footer>
        </article>
      @endforeach
    </div>

    {{-- Pagination. --}}
    {{ $articles->links() }}

  @else
    <div class="w-full mt-8 p-20">
      <strong>No articles found.</strong>
    </div>
  @endif
</div>

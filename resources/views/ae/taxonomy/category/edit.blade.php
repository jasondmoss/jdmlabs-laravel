@php
@endphp

@push('styles')
  @once
    <style>
			.items {
				display: flex;
				flex-direction: column;
				gap: 0.5rem 0;
			}

			.item {
				display: grid;
				grid-template-columns: 4rem 1fr;
				padding: 0.5rem 0.5rem 1rem;
			}

			.item dt {
				grid-column: 1;
			}

			.item dd {
				grid-column: 2;
			}
    </style>
  @endonce
@endpush

<x-ae.layout title="Edit Category" page="edit" livewire="true">
  <!-- edit.blade -->

  {{ html()
    ->modelForm($category, 'PUT', '/ae/taxonomy/category/update/' . $category->id)
    ->id('categoryForm')
    ->class('content-editor')
    ->open()
  }}

  {{ html()->hidden('id', $category->id) }}
  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="editor--header">
    <h1>
      <i class="fa-solid fa-pen-to-square"></i> {{ $category->name }}</h1>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend class="sr-only">{{ __('Content') }}</legend>

      <div class="form-field title">
        {{ html()->label('Name')->for('name') }}
        {{ html()->text('name')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> {{ $category->slug ?? '...' }}</p>
      </div>
    </fieldset>

    {{--
      Relationship: Articles
      ..........................................................................
    --}}
    @if (count($category->articles) > 0)
      <fieldset class="container-">
        <legend class="">{{ __('Articles') }}</legend>

        <div class="items">
          @foreach ($category->articles as $article)
            <dl id="Article_{{ $article->id }}" class="item">
              <dt>
                <figure class="item--image">
                  <a href="{{ action(\Aenginus\Article\Interface\Web\Controllers\EditController::class, $article->id) }}" title="{{ __('Edit') }}">
                    @if ($article->hasMedia('signatures'))
                      <img src="{{ $article->getFirstMediaUrl('signatures', 'preview') }}" alt="">
                    @else
                      <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
                    @endif
                  </a>
                </figure>
              </dt>
              <dd>
                <h3>
                  <a href="{{ action(\Aenginus\Article\Interface\Web\Controllers\EditController::class, $article->id) }}" title="{{ __('Edit') }}">{{ $article->title }}</a>
                </h3>
                <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $article->id }}</p>
              </dd>
            </dl>
          @endforeach
        </div>
      </fieldset>
    @endif
  </div>

  <aside class="editor--side">
    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>
      <div class="form-field">
        {{ html()->button('Save Category')->class('button button--submit') }}
      </div>
    </fieldset>
  </aside>

  <footer class="editor--footer">
    <a rel="prev" class="back-link" href="{{ URL::previous() }}">
      <span class="fa-solid fa-arrow-left mr-6"></span>
      {{ __('Back to last page') }}
    </a>
  </footer>

  {{ html()->form()->close() }}
</x-ae.layout>

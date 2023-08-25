<x-aenginus.layout title="Edit Category" page="edit" livewire="true">
  <!-- edit.blade -->

  <x-shared.session/>

  {{ html()
    ->modelForm($category, 'PUT', '/ae/taxonomy/category/update/' . $category->id)
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->open()
  }}

  {{ html()->hidden('id', $category->id) }}
  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="flex flex-col basis-full gap-3 align-middle justify-center z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="flex items-center gap-x-5 w-full pl-2 text-4xl font-medium">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
      {{ $category->name }}
    </h1>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Name')->for('name')->class('font-medium text-sm') }}
        {{ html()->text('name')->required()->class('text') }}
        <p><span class="font-bold mr-5">{{ __('slug') }}:</span> {{ $category->slug ?? '...' }}</p>
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
                    @if ($article->hasMedia('signature'))
                      <img src="{{ $article->getFirstMediaUrl('signature', 'preview') }}" alt="">
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

  <aside class="lg:basis-1/3 p-2">
    <fieldset class="px-2 py-10 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Actions') }}</legend>

      <div class="flex justify-end">
        {{ html()->button('Save Category')->type('submit')->class('form-submit bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm') }}
      </div>
    </fieldset>
  </aside>

  {{ html()->form()->close() }}
</x-aenginus.layout>

<?php
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
?>
<x-aenginus.layout
  title="Edit Article"
  page=" article"
  context=" edit"
  livewire="true"
>
  <!-- edit.blade -->

  <x-shared.session/>

  {{ html()
    ->modelForm($article, 'PUT', '/ae/article/update/' . $article->id)
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('id', $article->id) }}
  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="flex flex-col basis-full gap-3 align-middle justify-center z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="flex items-center gap-x-5 w-full pl-2 text-4xl font-medium">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
      {{ $article->title }}
    </h1>

    <p class="flex gap-x-5 px-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
      <a rel="external" href="{{ $article->permalink }}" title="{{ __('View live entry') }}">
        {{ $article->slug }}
      </a>
    </p>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Title')->for('title')->class('font-medium text-sm') }}
        {{ html()->text('title')->required()->class('text') }}
        <p><span class="font-bold mr-5">{{ __('slug') }}:</span> {{ $article->slug ?? '...' }}</p>
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="minimal"
          label="Summary"
          name="summary"
          value="{!! $article->summary !!}"
          placeholder="Write something..." />
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="full"
          label="Body"
          name="body"
          value="{!! $article->body !!}"
          placeholder="Write something..." />
      </div>
    </fieldset>

    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Taxonomy') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Categories')->for('category')->class('font-medium text-sm') }}
        {{
            html()
            ->select('category', $categories)
            ->class('form-select')
            ->placeholder('Choose a category')
            ->value($article->category_id)
        }}
      </div>
    </fieldset>

    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Signature Image') }}</legend>

      {{ html()->hidden('signature_image[collection]', 'signature') }}

      <div class="grid items-start gap-5">
        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Image')->for('signature_image[file]')->class('sr-only') }}
          {{ html()->file('signature_image[file]')->accept('jpg,png,svg')->attributes([
            'class' => 'file-uploader'
          ]) }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Name')->for('signature_image[label]') }}
          {{ html()->text('signature_image[label]', old('signature_image[label]', $article->image->label ?? null)) }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Alt Description')->for('signature_image[alt]') }}
          {{ html()->text('signature_image[alt]', old('signature_image[alt]', $article->image->alt ?? null)) }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Caption')->for('signature_image[caption]') }}
          {{ html()->text('signature_image[caption]', old('signature_image[caption]', $article->image->caption ?? null)) }}
        </div>

        <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
          {{--{!! $article->getSignatureImage() !!}--}}
        </figure>
      </div>
    </fieldset>
  </div>

  <aside class="lg:basis-1/3 p-2">
    <div class="md:sticky md:top-24">
      <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
        <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Meta') }}</legend>

        <div class="flex items-center justify-between">
          {{ html()->label('Status')->for('status') }}
          <select name="status" id="status" class="form-select">
            @foreach(Status::cases() as $status)
              <option value="{{ $status->value }}" @if ($article->status && $article->status->value === $status->value) selected @endif>
                {{ $status->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-between">
          {{ html()->label('Featured?')->for('promoted') }}
          <select name="promoted" id="promoted" class="form-select">
            @foreach(Promoted::cases() as $promoted)
              <option value="{{ $promoted->value }}" @if ($article->promoted && $article->promoted->value === $promoted->value) selected @endif>{{ $promoted->name }}</option>
            @endforeach
          </select>
        </div>
      </fieldset>

      <fieldset class="my-10 px-2 py-10 border-t border-gray-300">
        <legend class="sr-only">{{ __('Form Actions') }}</legend>

        <div class="flex justify-end">
          {{ html()->button('Save Article')->type('submit')->class('form-submit bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm') }}
        </div>
      </fieldset>
    </div>
  </aside>

  {{ html()->form()->close() }}
</x-aenginus.layout>

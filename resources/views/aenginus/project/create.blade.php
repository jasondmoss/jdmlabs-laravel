<?php
  use Aenginus\Shared\Enums\Pinned;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
?>
<x-aenginus.layout
  title="Create New Project"
  page=" project"
  context=" create"
  livewire="true"
>
  <!-- create.blade -->

  <x-shared.session/>

  {{ html()->form('POST', '/ae/project/create')
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="flex flex-col basis-full md:flex-row gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:justify-between md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="pl-2 text-4xl font-medium">{{ __('Create New Project') }}</h1>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Title')->for('title')->class('font-medium text-sm') }}
        {{ html()->text('title')->required() }}
        <p><span class="font-bold mr-5">{{ __('slug') }}:</span> ...</p>
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Sub-Title')->for('subtitle')->class('font-medium text-sm') }}
        {{ html()->text('subtitle')->required()->placeholder(__('Project sub-title or tagline')) }}
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Website')->for('website')->class('font-medium text-sm') }}
        {{ html()->input('website')->type('url')->name('website')->attributes([
          'pattern' => 'https://.*'
        ])->required()->placeholder(__('https:// ...')) }}
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Client')->for('client_id')->class('font-medium text-sm') }}
        {{ html()->select('client_id', $clients)->required()->placeholder('Choose a client') }}
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="minimal"
          label="Summary"
          name="summary"
          placeholder="Write something..." />
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="full"
          label="Body"
          name="body"
          placeholder="Write something..." />
      </div>
    </fieldset>

    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Taxonomy') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Categories')->for('category_id')->class('font-medium text-sm') }}
        {{ html()->select('category_id', $categories)->placeholder('Choose a category') }}
      </div>
    </fieldset>

    <fieldset class="signature-image flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Signature Image') }}</legend>

      {{ html()->hidden('signature_image[collection]', 'signature') }}

      <div class="grid items-start gap-5">
        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Image')->for('signature_image[file]')->class('sr-only') }}
          {{ html()->file('signature_image[file]')->accept('jpg,png,svg')->class('file py-2 px-4 bg-gray-100') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Name')->for('signature_image[label]')->class('font-medium text-sm') }}
          {{ html()->text('signature_image[label]') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Alt Description')->for('signature_image[alt]')->class('font-medium text-sm') }}
          {{ html()->text('signature_image[alt]') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Caption')->for('signature_image[caption]')->class('font-medium text-sm') }}
          {{ html()->text('signature_image[caption]') }}
        </div>

        <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
          <img class="image-previewer" src="{{ asset('images/placeholder/signature.png') }}" alt="">
        </figure>
      </div>
    </fieldset>

    <fieldset class="showcase-images flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Showcase Images') }}</legend>

      <div class="repeatable-wrapper flex flex-col gap-y-10">
        <div class="repeatable grid items-start gap-5">
          {{ html()->hidden('showcase_images[0][collection]', 'showcase') }}

          <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
            {{ html()->label('Image')->for('showcase_images[0][file]')->class('sr-only') }}
            {{ html()->file('showcase_images[0][file]')->forgetAttribute('id')->class('file py-2 px-4 bg-gray-100')->accept('jpg,png,svg') }}
          </div>

          <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
            {{ html()->label('Name')->for('showcase_images[0][label]') }}
            {{ html()->text('showcase_images[0][label]')->class('label')->forgetAttribute('id') }}
          </div>

          <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
            {{ html()->label('Alt Description')->for('showcase_images[0][alt]') }}
            {{ html()->text('showcase_images[0][alt]')->class('alt')->forgetAttribute('id') }}
          </div>

          <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
            {{ html()->label('Caption')->for('showcase_images[0][caption]') }}
            {{ html()->text('showcase_images[0][caption]')->class('caption')->forgetAttribute('id') }}
          </div>

          <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
            <img class="image-previewer" src="{{ asset('images/placeholder/showcase.png') }}" alt="">
          </figure>
        </div>
      </div>

      <div class="flex justify-end md:pr-5">
        <button type="button" class="repeater w-fit bg-amber-300 hover:bg-amber-500 shadow-sm shadow-amber-200 text-amber-800 hover:text-white font-medium py-2 px-4 rounded-sm">{{ __('New Showcase Image') }}</button>
      </div>
    </fieldset>
  </div>

  <aside class="lg:basis-1/3 p-2">
    <div class="md:sticky md:top-24">
      <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
        <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Meta') }}</legend>

        <div class="flex items-center justify-between">
          {{ html()->label('Status')->for('status') }}
          <select name="status">
            @foreach (Status::cases() as $status)
              <option value="{{ $status->value }}">{{ $status->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-between">
          {{ html()->label('Featured?')->for('promoted') }}
          <select name="promoted">
            @foreach (Promoted::cases() as $promoted)
              <option value="{{ $promoted->value }}">{{ $promoted->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-between">
          {{ html()->label('Featured?')->for('pinned') }}
          <select name="pinned">
            @foreach(Pinned::cases() as $pinned)
              <option value="{{ $pinned->value }}">{{ $pinned->name }}</option>
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

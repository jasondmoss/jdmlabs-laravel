<?php
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
?>
<x-aenginus.layout
  title="Create New Client"
  page=" client"
  context=" create"
  livewire="true"
>
  <!-- create.blade -->

  <x-shared.session/>

  {{ html()
    ->form('POST', '/ae/client/create')
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="flex flex-col basis-full md:flex-row gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:justify-between md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="pl-2 text-4xl font-medium">{{ __('Create New Client') }}</h1>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <fieldset class="form-content flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Name')->for('name')->class('font-medium text-sm') }}
        {{ html()->text('name')->required() }}
        <p><span class="font-bold mr-5">{{ __('slug') }}:</span> ...</p>
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Schema Itemprop')->for('itemprop')->class('font-medium text-sm') }}
        {{ html()->text('itemprop')->required() }}
        <small>{{ __('See') }} <a rel="external" href="https://schema.org/docs/full.html" title="A set of extensible schemas to embed structured data on web pages">Schema.org</a></small>
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Website')->for('website')->class('font-medium text-sm') }}
        {{ html()->input('website')->type('url')->name('website')->required() }}
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="minimal"
          label="Summary"
          name="summary"
          placeholder="Write something..." />
      </div>
    </fieldset>

    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Company Logo') }}</legend>

      {{ html()->hidden('logo_image[collection]', 'logo') }}

      <div class="form-image grid items-start gap-5">
        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Image')->for('logo_image[file]')->class('sr-only') }}
          {{ html()->file('logo_image[file]')->accept('jpg,png')->class('file-uploader py-2 px-4 bg-gray-100') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Name')->for('logo_image[label]')->class('font-medium text-sm') }}
          {{ html()->text('logo_image[label]') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Alt Description')->for('logo_image[alt]')->class('font-medium text-sm') }}
          {{ html()->text('logo_image[alt]') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Caption')->for('logo_image[caption]')->class('font-medium text-sm') }}
          {{ html()->text('logo_image[caption]') }}
        </div>

        <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
          <x-shared.media.preview :model=$client context="logo" />
        </figure>
      </div>
    </fieldset>
  </div>

  <aside class="lg:basis-1/3 p-2">
    <div class="md:sticky md:top-24">
      <fieldset class="form-meta flex flex-col gap-y-5 px-2 border-t border-gray-300">
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
      </fieldset>

      <fieldset class="form-actions my-10 px-2 py-10 border-t border-gray-300">
        <legend class="sr-only">{{ __('Form Actions') }}</legend>

        <div class="flex justify-end">
          {{ html()->button('Save Client')->type('submit')->class('form-submit bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm') }}
        </div>
      </fieldset>
    </div>
  </aside>

  {{ html()->form()->close() }}
</x-aenginus.layout>

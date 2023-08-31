<?php
  use Aenginus\Shared\Enums\Pinned;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
?>
<x-aenginus.layout
  title="Edit Project"
  page=" project"
  context=" edit"
  livewire="true"
>
  <!-- edit.blade -->

  <x-shared.session/>

  {{ html()
    ->modelForm($project, 'PUT', '/ae/project/update/' . $project->id)
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('id', $project->id) }}
  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="flex flex-col basis-full gap-3 align-middle justify-center z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="flex items-center gap-x-5 w-full pl-2 text-4xl font-medium">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
      {{ $project->title }}
    </h1>

    <p class="flex gap-x-5 px-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
      <a rel="external" href="{{ $project->permalink }}" title="{{ __('View live entry') }}">
        {{ $project->slug }}
      </a>
    </p>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <!--
        CONTENT
        ////////////////////////////////////////////////////////////////////////
    -->
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Title')->for('title')->class('font-medium text-sm') }}
        {{ html()->text('title')->required() }}
        <p class=""><span class="font-bold mr-5">{{ __('slug') }}:</span> {{ $project->slug ?? '...' }}</p>
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Sub-Title')->for('subtitle')->class('font-medium text-sm') }}
        {{ html()->text('subtitle')->required()->placeholder(__('Project sub-title or tagline')) }}
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Website')->for('website')->class('font-medium text-sm') }}
        {{ html()->input('website')->type('url')->name('website')->attributes([
          'pattern' => 'https://.*'
        ])->required()->value($project->website) }}
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
          value="{!! $project->summary !!}"
          placeholder="Write something..." />
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="full"
          label="Body"
          name="body"
          value="{!! $project->body !!}"
          placeholder="Write something..." />
      </div>
    </fieldset>

    <!--
        TAXONOMY
        ////////////////////////////////////////////////////////////////////////
    -->
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Taxonomy') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Categories')->for('category_id')->class('font-medium text-sm') }}
        {{ html()->select('category_id', $categories)->class('form-select')->value($project->category_id)->placeholder('Choose a category') }}
      </div>
    </fieldset>

    <!--
        SIGNATURE IMAGE
        ////////////////////////////////////////////////////////////////////////
    -->
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Signature Image') }}</legend>

      <div class="grid items-start gap-5">
        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Image')->for('signature_image[file]')->class('sr-only') }}
          {{ html()->file('signature_image[file]')->accept('jpg,png,svg')->class('file-uploader py-2 px-4 bg-gray-100') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Name')->for('signature_image[label]')->class('font-medium text-sm') }}
          @if ($signature !== null)
            {{ html()->text('signature_image[label]', old('signature_image[label]', $signature->custom_properties['label'])) }}
          @else
            {{ html()->text('signature_image[label]') }}
          @endif
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Alt Description')->for('signature_image[alt]')->class('font-medium text-sm') }}
          @if ($signature !== null)
            {{ html()->text('signature_image[alt]', old('signature_image[alt]', $signature->custom_properties['alt'])) }}
          @else
            {{ html()->text('signature_image[alt]') }}
          @endif
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Caption')->for('signature_image[caption]')->class('font-medium text-sm') }}
          @if ($signature !== null)
            {{ html()->text('signature_image[caption]', old('signature_image[caption]', $signature->custom_properties['caption'])) }}
          @else
            {{ html()->text('signature_image[caption]') }}
          @endif
        </div>

        <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
          @if ($project->hasMedia('signature'))
            <img class="image-previewer" src="{{ $project->getFirstMediaUrl('signature') }}" alt="">
          @else
            <img class="image-previewer" src="{{ asset('images/placeholder/signature.png') }}" alt="">
          @endif
        </figure>
      </div>
    </fieldset>

    <!--
        SHOWCASE IMAGES
        ////////////////////////////////////////////////////////////////////////
    -->
    <fieldset class="showcase-images flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Showcase Images') }}</legend>

      <div class="repeatable-wrapper flex flex-col gap-y-10">
        @if (count($showcase_images) > 0)
          @foreach ($showcase_images as $key => $showcase)
            <div class="repeatable grid items-start gap-5">
              <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
                {{ html()->label('Image')->for('showcase_images[' . $key . '][file]')->class('sr-only') }}
                {{ html()->file('showcase_images[' . $key . '][file]')->forgetAttribute('id')->accept('jpg,png,svg')->class('file-uploader py-2 px-4 bg-lime-100') }}
              </div>

              <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
                {{ html()->label('Name')->for('showcase_images[' . $key . '][label]')->class('font-medium text-sm') }}
                {{ html()->text('showcase_images[' . $key . '][label]')->forgetAttribute('id')->class('label')->value($showcase->custom_properties['label'] ?? '') }}
              </div>

              <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
                {{ html()->label('Alt Description')->for('showcase_images[' . $key . '][alt]')->class('font-medium text-sm') }}
                {{ html()->text('showcase_images[' . $key . '][alt]')->forgetAttribute('id')->class('alt')->value($showcase->custom_properties['alt'] ?? '') }}
              </div>

              <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
                {{ html()->label('Caption')->for('showcase_images[' . $key . '][caption]')->class('font-medium text-sm') }}
                {{ html()->text('showcase_images[' . $key . '][caption]')->forgetAttribute('id')->class('caption')->value($showcase->custom_properties['caption'] ?? '') }}
              </div>

              <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
                {{ $showcase }}
              </figure>
            </div>
          @endforeach
        @else
          <div class="repeatable grid items-start gap-5">
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
        @endif
      </div>

      <div class="flex justify-end md:pr-5">
        <button type="button" class="repeater w-fit bg-amber-300 hover:bg-amber-500 shadow-sm shadow-amber-200 text-amber-800 hover:text-white font-medium py-2 px-4 rounded-sm">{{ __('New Showcase Image') }}</button>
      </div>
    </fieldset>
  </div>

  <!--
      METADATA + ACTIONS
      ////////////////////////////////////////////////////////////////////////
  -->
  <aside class="lg:basis-1/3 p-2">
    <div class="md:sticky md:top-24">
      <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
        <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Meta') }}</legend>

        <div class="flex items-center justify-between">
          {{ html()->label('Status')->for('status')->class('font-medium text-sm') }}
          <select name="status">
            @foreach (Status::cases() as $status)
              <option value="{{ $status->value }}"{{ $project->status && ($project->status->value === $status->value) ? ' selected'  : '' }}>{{ $status->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-between">
          {{ html()->label('Featured?')->for('promoted')->class('font-medium text-sm') }}
          <select name="promoted">
            @foreach (Promoted::cases() as $promoted)
              <option value="{{ $promoted->value }}"{{ $project->promoted && ($project->promoted->value === $promoted->value) ? ' selected'  : '' }}>{{ $promoted->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-between">
          {{ html()->label('Featured?')->for('pinned')->class('font-medium text-sm') }}
          <select name="pinned">
            @foreach(Pinned::cases() as $pinned)
              <option value="{{ $pinned->value }}"{{ $project->pinned && ($project->pinned->value === $pinned->value) ? ' selected'  : '' }}>{{ $pinned->name }}</option>
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

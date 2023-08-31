<?php
  use Aenginus\Project\Interface\Web\Controllers as Project;
  use Aenginus\Shared\Enums\Pinned;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel as Category;
?>
<x-aenginus.layout
  title="Edit Client"
  page=" client"
  context=" edit"
  livewire="true"
>
  <!-- edit.blade -->

  <x-shared.session/>

  {{ html()
    ->modelForm($client, 'PUT', '/ae/client/update/' . $client->id)
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('id', $client->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="flex flex-col basis-full gap-3 align-middle justify-center z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="flex items-center gap-x-5 w-full pl-2 text-4xl font-medium">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
      {{ $client->name }}
    </h1>

    <p class="flex gap-x-5 px-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
      <a rel="external" href="{{ $client->permalink }}" title="{{ __('View live entry') }}">
        {{ $client->slug }}
      </a>
    </p>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Name')->for('name')->class('font-medium text-sm') }}
        {{ html()->text('name')->required() }}
        <p><span class="font-bold mr-5">{{ __('slug') }}:</span> {{ $client->slug ?? '...' }}</p>
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Schema Itemprop')->for('itemprop')->class('font-medium text-sm') }}
        {{ html()->text('itemprop')->required() }}

        <small>{{ __('See') }}<a rel="external" href="https://schema.org/docs/full.html" title="A set of extensible schemas to embed structured data on web pages">Schema.org</a></small>
      </div>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Website')->for('website') }}
        {{ html()->input('website')->type('url')->class('text')->attributes([
          'id' => 'website',
          'name' => 'website',
          'required'
        ])->value(old('website', $client->website)) }}
      </div>

      <div class="flex flex-col gap-y-3">
        <x-shared.trix-editor
          type="minimal"
          label="Summary"
          name="summary"
          value="{!! $client->summary !!}"
          placeholder="Write something..." />
      </div>
    </fieldset>

    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Company Logo') }}</legend>

      <div class="grid items-start gap-5">
        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Image')->for('logo_image[file]')->class('sr-only') }}
          {{ html()->file('logo_image[file]')->accept('jpg,png,svg')->class('file-uploader py-2 px-4 bg-gray-100') }}
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Name')->for('logo_image[label]')->class('font-medium text-sm') }}
          @if ($logo !== null)
            {{ html()->text('logo_image[label]', old('logo_image[label]', $logo->custom_properties['label'])) }}
          @else
            {{ html()->text('logo_image[label]') }}
          @endif
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Alt Description')->for('logo_image[alt]')->class('font-medium text-sm') }}
          @if ($logo !== null)
            {{ html()->text('logo_image[alt]', old('logo_image[alt]', $logo->custom_properties['alt'])) }}
          @else
            {{ html()->text('logo_image[alt]') }}
          @endif
        </div>

        <div class="sm:col-start-1 sm:col-span-3 flex flex-col gap-y-3">
          {{ html()->label('Caption')->for('logo_image[caption]')->class('font-medium text-sm') }}
          @if ($logo !== null)
            {{ html()->text('logo_image[caption]', old('logo_image[caption]', $logo->custom_properties['caption'])) }}
          @else
            {{ html()->text('logo_image[caption]') }}
          @endif
        </div>

        <figure class="sm:col-start-4 sm:col-end-4 sm:row-start-1 sm:row-span-4 sm:max-w-xs">
          @if ($client->hasMedia('logo'))
            <img class="image-previewer" src="{{ $client->getFirstMediaUrl('logo') }}" alt="">
          @else
            <img class="image-previewer" src="{{ asset('images/placeholder/logo.png') }}" alt="">
          @endif
        </figure>
      </div>
    </fieldset>

    {{--
      Relationship: Projects
      ..........................................................................
    --}}
    @if (count($client->projects) > 0)
<table class="flex flex-col gap-y-4 max-w-sm mx-auto mt-10 mb-0 md:table md:max-w-full md:m-0 lg:mt-4 text-left text-sm font-medium">
  <tbody class="flex flex-col gap-y-10 md:table-row-group w-full">
    @foreach ($client->projects as $project)
      @php $permalink = url('/project/' . $project->slug); @endphp

      <!-- Item -->
      <tr id="item-{{ $project->id }}" class="flex flex-col max-w-full md:table-row border-b odd:bg-white even:bg-slate-50">
        <td class="block w-full md:table-cell md:w-20 py-2">
          <figure class="">
            <a class="block" href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">
              @if ($project->hasMedia('signature'))
                <img class="max-w-full mx-auto" src="{{ $project->getFirstMediaUrl('signature', 'thumb100') }}" alt="">
              @else
                <img class="max-w-full mx-auto" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif
            </a>
          </figure>
        </td>
        <td class="block md:table-cell md:align-top md:px-6 py-6"><div class="flex flex-col gap-y-2">
          <a rel="external" class="font-bold text-base xl:text-xl text-sky-600 hover:text-black" href="{{ $permalink }}" title="{{ __('View project') }}">{{ $project->title }}</a>
          <p class="flex gap-x-3" title="{{ __('Project Ulid') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5"><path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 00-3.722 1.118.75.75 0 11-.828-1.25 8.25 8.25 0 0112.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 01-1.395-.551A21.69 21.69 0 0018.75 10.5 6.75 6.75 0 0012 3.75zM6.157 5.739a.75.75 0 01.21 1.04A6.715 6.715 0 005.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 01-1.27-.8A6.715 6.715 0 003.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 011.04-.211zM12 7.5a3 3 0 00-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 11-1.112-1.008A10.459 10.459 0 007.5 10.5a4.5 4.5 0 119 0c0 .547-.022 1.09-.067 1.626a.75.75 0 01-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 00-3-3zm0 2.25a.75.75 0 01.75.75A15.69 15.69 0 018.97 20.738a.75.75 0 01-1.14-.975A14.19 14.19 0 0011.25 10.5a.75.75 0 01.75-.75zm3.239 5.183a.75.75 0 01.515.927 19.415 19.415 0 01-2.585 5.544.75.75 0 11-1.243-.84 17.912 17.912 0 002.386-5.116.75.75 0 01.927-.515z" clip-rule="evenodd" /></svg>
            {{ $project->id }}
          </p>
          @if ($project->category_id !== null)
            @php $category = Category::where('id', '=', $project->category_id)->get()->first(); @endphp
            <p class="flex gap-x-3">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5"><path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" /></svg>
              <a itemprop="tag" class="px-3 py-1 shadow-sm shadow-sky-300 bg-sky-500 hover:bg-sky-600 rounded-sm text-xs text-white" href="{{ action(Taxonomy\EditController::class, $category->id) }}" title="{{ __('Edit category') }}">{{ $category->name }}</a>
            </p>
          @endif
        </div></td>
        <td class="block py-6 text-right md:table-cell md:align-top md:w-56 md:px-6">
          <div class="flex justify-end gap-3 pb-5">
            <span class="status" wire:click="toggleStatePublished('{{ $project->id }}')" title="@if ($project->status->value === 'published') {{ __('Unpublish this project') }} @else {{ __('Publish this project') }} @endif">
              {!! Status::icon($project->status) !!}
            </span>
            <span class="promoted" wire:click="toggleStatePromoted('{{ $project->id }}')" title="@if ($project->promoted->value === 'promoted') {{ __('Unpromote this project') }} @else {{ __('Promote this project') }} @endif">
              {!! Promoted::icon($project->promoted) !!}
            </span>
            <span class="promoted" wire:click="toggleStatePinned('{{ $project->id }}')" title="@if ($project->pinned->value === 'pinned') {{ __('Unpin this project') }} @else {{ __('Pin this project') }} @endif">
              {!! Pinned::icon($project->pinned) !!}
            </span>
          </div>
          <time class="flex md:justify-end gap-x-4 pt-1 text-lg lg:text-base" datetime="{{ Date::parse($project->updated_at)->format('c') }}" title="{{ Date::parse($project->updated_at)->format('c') }}">
            {{ Date::parse($project->updated_at)->format('Y/m/d \\@ H:i:s') }}
          </time>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
    @endif
  </div>
  {{--  / Relationship: Projects  --}}

  <aside class="lg:basis-1/3 p-2">
    <div class="md:sticky md:top-24">
      <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
        <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Meta') }}</legend>

        <div class="flex items-center justify-between">
          {{ html()->label('Status')->for('status') }}
          <select name="status" id="status" class="form-select">
            @foreach(Status::cases() as $status)
              <option value="{{ $status->value }}" @if ($client->status && $client->status->value === $status->value) selected @endif>
                {{ $status->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-between">
          {{ html()->label('Featured?')->for('promoted') }}
          <select name="promoted" id="promoted" class="form-select">
            @foreach(Promoted::cases() as $promoted)
              <option value="{{ $promoted->value }}" @if ($client->promoted && $client->promoted->value === $promoted->value) selected @endif>{{ $promoted->name }}</option>
            @endforeach
          </select>
        </div>
      </fieldset>

      <fieldset class="my-10 px-2 py-10 border-t border-gray-300">
        <legend class="sr-only">{{ __('Form Actions') }}</legend>

        <div class="flex justify-end">
          {{ html()->button('Save Client')->type('submit')->class('form-submit bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm') }}
        </div>
      </fieldset>
    </div>
  </aside>

  {{ html()->form()->close() }}
</x-aenginus.layout>

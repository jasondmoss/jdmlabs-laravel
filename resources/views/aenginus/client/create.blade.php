@php
  use Aenginus\Shared\Enums\Promoted;use Aenginus\Shared\Enums\Status;
@endphp
@push('scripts')
  @once
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
		ClassicEditor.create(document.getElementById("summary"), {
			removePlugins: [ "Heading", "List", "Alignment", "CodeBlock", "MediaEmbed" ]
		}).catch(error => console.error(error));
    </script>
  @endonce
@endpush

<x-aenginus.layout title="Create New Client" page="create" livewire="true">
  <!-- create.blade -->

  <x-shared.session/>

  {{ html()
    ->form('POST', '/ae/client/create')
    ->id('clientForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="editor--header">
    <h1>{{ __('Create New ClientEloquentModel') }}</h1>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>

      <div class="form-field title">
        {{ html()->label('Name')->for('name') }}
        {{ html()->text('name')->attribute('required')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> ...</p>
      </div>

      <div class="form-field schema">
        {{ html()->label('Schema Itemprop')->for('itemprop') }}
        {{ html()->text('itemprop')->attribute('required')->class('text')->attribute('required') }}
        <small>{{ __('See') }}
          <a rel="external" href="https://schema.org/docs/full.html" title="A set of extensible schemas to embed structured data on web pages">Schema.org</a>
        </small>
      </div>

      <div class="form-field website">
        {{ html()->label('Website')->for('website') }}
        {{ html()->input('website')->type('url')->class('text')->attributes([
          'id' => 'website',
          'name' => 'website',
          'required'
        ]) }}
      </div>

      <div class="form-field summary">
        {{ html()->label('Summary')->for('summary') }}
        {{ html()->textarea('summary')->attribute('required')->class('textarea')->rows(4) }}
      </div>
    </fieldset>

    <fieldset class="container--images single">
      <legend>{{ __('Company Logo') }}</legend>

      <div class="wrapper">
        <div class="form-field">
          {{ html()->label('Image')->for('logo_image[file]')->class('sr-only') }}
          {{ html()->file('logo_image[file]')->accept('jpg,png,svg')->attributes([
            'class' => 'file-uploader'
          ]) }}
        </div>

        <div class="form-field">
          {{ html()->label('Name')->for('logo_image[label]') }}
          {{ html()->text('logo_image[label]')->class('text') }}
        </div>

        <div class="form-field">
          {{ html()->label('Alt Description')->for('logo_image[alt]') }}
          {{ html()->text('logo_image[alt]')->class('text') }}
        </div>

        <div class="form-field">
          {{ html()->label('Caption')->for('logo_image[caption]') }}
          {{ html()->text('logo_image[caption]')->class('text') }}
        </div>

        <figure class="item--image">
          <img class="image-previewer" src="{{ asset('images/placeholder/logo.png') }}" alt="">
        </figure>
      </div>
    </fieldset>
  </div>

  <aside class="editor--side">
    <fieldset class="container--meta">
      <legend>{{ __('Meta') }}</legend>

      <div class="form-field status">
        {{ html()->label('Status')->for('status') }}
        <select name="status" id="status" class="select">
          @foreach(Status::cases() as $status)
            <option value="{{ $status->value }}">{{ $status->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-field promoted">
        {{ html()->label('Featured?')->for('promoted') }}
        <select name="promoted" id="promoted" class="select">
          @foreach(Promoted::cases() as $promoted)
            <option value="{{ $promoted->value }}">{{ $promoted->name }}</option>
          @endforeach
        </select>
      </div>
    </fieldset>

    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>

      <div class="form-field actions">
        {{ html()->button('Save Client')->type('submit')->class('button button--submit') }}
      </div>
    </fieldset>
  </aside>

  <footer class="editor--footer">
    <a rel="prev" class="back-link" href="{{ URL::previous() }}">
      <span class="fa-solid fa-arrow-left mr-6"></span> {{ __('Back to last page') }}
    </a>
  </footer>
  {{ html()->form()->close() }}
</x-aenginus.layout>

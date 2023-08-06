@php
  use Aenginus\Shared\Enums\Pinned;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
@endphp
@push('scripts')
  @once
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
document.querySelectorAll(".textarea:not(.full)").forEach((edit) => {
    ClassicEditor.create(edit, {
        removePlugins: [ "Heading", "List", "Alignment", "CodeBlock", "MediaEmbed" ]
    }).catch(
        error => console.error(error)
    );
});
ClassicEditor.create(document.getElementById("body")).catch(
    error => console.error(error)
);
    </script>
  @endonce
@endpush

<x-ae.layout title="Create New Project" page="create" livewire="true">
  <!-- create.blade -->

  <x-shared.session/>

  {{ html()->form('POST', '/ae/project/create')
    ->id('projectForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->attributes([
        'wire:submit.prevent' => 'uploadMultipleFiles'
    ])
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="editor--header">
    <h1>{{ __('Create New Project') }}</h1>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>

      <div class="form-field title">
        {{ html()->label('Title')->for('title') }}
        {{ html()->text('title')->class('text')->attribute('required')->placeholder(__('Project name')) }}
        <p class="title-slug"><span class="label">{{ __('slug') }}</span> ...</p>
      </div>

      <div class="form-field subtitle">
        {{ html()->label('Sub-Title')->for('subtitle') }}
        {{ html()->text('subtitle')->class('text')->attribute('required')->placeholder(__('Project sub-title or tagline')) }}
      </div>

      <div class="form-field website">
        {{ html()->label('Website')->for('website') }}
        {{ html()->input('website')->type('url')->class('text')->attributes([
          'id' => 'website',
          'name' => 'website',
        ]) }}
      </div>

      <div class="form-field summary">
        {{ html()->label('Summary')->for('summary') }}
        {{ html()->textarea('summary')->class('textarea')->rows(4)->placeholder(__('An SEO compatible summary')) }}
      </div>

      <div class="form-field body">
        {{ html()->label('Main Content')->for('body') }}
        {{ html()->textarea('body')->class('textarea full')->rows(15)->placeholder(__('Full description of this project')) }}
      </div>
    </fieldset>

    <fieldset class="container--clients">
      <legend>{{ __('Clients') }}</legend>

      <div class="form-field clients">
        {{ html()->label('Client')->for('client_id') }}
        {{ html()->select('client_id', $clients)->class('form-control select')->attribute('required')->placeholder('Choose a client') }}
      </div>
    </fieldset>

    <fieldset class="container--taxonomy">
      <legend>{{ __('Taxonomy') }}</legend>

      <div class="form-field taxonomy">
        {{ html()->label('Categories')->for('category_id') }}
        {{ html()
          ->select('category_id', $categories)
          ->class('form-control select')
          ->placeholder('Choose a category')
        }}
      </div>
    </fieldset>

    <fieldset class="container--signature-image">
      <legend>{{ __('Signature Image') }}</legend>

      <div class="form-field">
        {{ html()->label('Image')->for('signature_image[file]')->class('sr-only') }}
        {{ html()->file('signature_image[file]')->accept('jpg,png,svg')->attributes([
          'id' => 'signature',
          'class' => 'upload'
        ]) }}
      </div>

      <div class="form-field">
        {{ html()->label('Name')->for('signature_image[label]') }}
        {{ html()->text('signature_image[label]')->class('text') }}
      </div>

      <div class="form-field">
        {{ html()->label('Alt Description')->for('signature_image[alt]') }}
        {{ html()->text('signature_image[alt]')->class('text') }}
      </div>

      <div class="form-field">
        {{ html()->label('Caption')->for('signature_image[caption]') }}
        {{ html()->text('signature_image[caption]')->class('text') }}
      </div>

      <figure class="item--image">
        <img id="previewer" src="{{ asset('images/placeholder/signature.png') }}" alt="">
      </figure>
    </fieldset>

    <fieldset class="container--showcase-images">
      <legend>{{ __('Showcase Images') }}</legend>

      <div class="form-field">
        {{ html()->label('Images')->for('showcase_images[][file]')->class('sr-only') }}
        {{ html()->file('showcase_images[][file]')->multiple()->accept('jpg,png,svg')->attributes([
          'id' => 'showcase',
          'class' => 'upload'
        ]) }}
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

      <div class="form-field pinned">
        {{ html()->label('Featured?')->for('pinned') }}
        <select name="pinned" id="pinned" class="select">
          @foreach(Pinned::cases() as $pinned)
            <option value="{{ $pinned->value }}">{{ $pinned->name }}</option>
          @endforeach
        </select>
      </div>
    </fieldset>

    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>

      <div class="form-field actions">
        {{ html()->button('Save Project')->class('button button--submit') }}
      </div>
    </fieldset>
  </aside>

  <footer class="editor--footer">
    <a rel="prev" class="back-link" href="{{ URL::previous() }}">
      <span class="fa-solid fa-arrow-left mr-6"></span> {{ __('Back to last page') }}
    </a>
  </footer>

  {{ html()->form()->close() }}
</x-ae.layout>

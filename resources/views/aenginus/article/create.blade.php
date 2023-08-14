@php
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

<x-aenginus.layout title="Create New Article" page="create" livewire="true">
  <!-- create.blade -->

  {{ html()
    ->form('POST', '/ae/article/create')
    ->id('articleForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="editor--header">
    <h1>{{ __('Create New ArticleEloquentModel') }}</h1>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>
      <div class="form-field title">
        {{ html()->label('Title')->for('title') }}
        {{ html()->text('title')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> ...</p>
      </div>

      <div class="form-field summary">
        {{ html()->label('Summary')->for('summary') }}
        {{ html()->textarea('summary')->attribute('required')->class('textarea summary')->rows(4) }}
      </div>

      <div class="form-field body">
        {{ html()->label('Body')->for('body') }}
        {{ html()->textarea('body')->attribute('required')->class('textarea full')->rows(15) }}
      </div>
    </fieldset>

    <fieldset class="container--taxonomy">
      <legend>{{ __('Taxonomy') }}</legend>

      <div class="form-field taxonomy">
        {{ html()->label('Categories')->for('category') }}
        {{ html()->select('category', $categories)->class('form-control select')->placeholder('Choose a category') }}
      </div>
    </fieldset>

    <fieldset class="container--images single">
      <legend>{{ __('Signature Image') }}</legend>

      <div class="wrapper">
        <div class="form-field">
          {{ html()->label('Image')->for('signature_image[file]')->class('sr-only') }}
          {{ html()->file('signature_image[file]')->accept('jpg,png,svg')->attributes([
            'class' => 'file-uploader'
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
          <img class="image-previewer" src="{{ asset('images/placeholder/signature.png') }}" alt="">
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
          @foreach (Status::cases() as $status)
            <option value="{{ $status->value }}">{{ $status->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-field promoted">
        {{ html()->label('Featured?')->for('promoted') }}
        <select name="promoted" id="promoted" class="select">
          @foreach (Promoted::cases() as $promoted)
            <option value="{{ $promoted->value }}">{{ $promoted->name }}</option>
          @endforeach
        </select>
      </div>
    </fieldset>

    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>
      <div class="form-field">
        {{ html()->button('Save Article')->class('bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm') }}
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
</x-aenginus.layout>

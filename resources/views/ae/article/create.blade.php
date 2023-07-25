@php
use App\Shared\Enums\Status;
use App\Shared\Enums\Promoted;
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

<x-ae.layout title="Create New Article" page="create" livewire="true">
  {{ html()
    ->form('POST', '/ae/article/create')
    ->id('articleForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="editor--header">
    <h1>{{ __('Create New Article') }}</h1>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>
      <div class="form-field title">
        {{ html()->label('Title')->for('title') }}
        {{ html()->text('title')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> ...</p>

          @error('title')
            <x-shared.message type="error" context="title" :message="$errors"/>
          @enderror
      </div>

      <div class="form-field summary">
        {{ html()->label('Summary')->for('summary') }}
        {{ html()->textarea('summary')->class('textarea summary')->rows(4) }}

        @error('summary')
          <x-shared.message type="error" context="summary" :message="$errors"/>
        @enderror
      </div>

      <div class="form-field body">
        {{ html()->label('Body')->for('body') }}
        {{ html()->textarea('body')->class('textarea full')->rows(15) }}

        @error('body')
          <x-shared.message type="error" context="body" :message="$errors"/>
        @enderror
      </div>
    </fieldset>

    <fieldset class="container--taxonomy">
      <legend>{{ __('Taxonomy') }}</legend>

      <div class="form-field taxonomy">
        {{ html()->label('Categories')->for('category') }}
        {{ html()->select('category', $categories)->class('form-control select')->attribute('required')->placeholder('Choose a category') }}
      </div>
    </fieldset>

    {{--<fieldset class="container--signature-image">
      <legend>{{ __('Signature Image') }}</legend>
      <div class="form-field">
        {{ html()->label('Image')->for('image[file]')->class('sr-only') }}
        {{ html()->file('image[file]')->accept('jpg,png,svg')->attributes([
          'id' => 'signature_image',
          'class' => 'upload'
        ]) }}
      </div>

      <div class="form-field">
        {{ html()->label('Name')->for('image[label]') }}
        @if ($article->signature)
          {{ html()->text('image[label]', old('image[label]', $article->signature->custom_properties['label']))->class('text') }}
        @else
          {{ html()->text('image[label]')->class('text') }}
        @endif
      </div>

      <div class="form-field">
        {{ html()->label('Alt Description')->for('image[alt]') }}
        @if ($article->signature)
          {{ html()->text('image[alt]', old('image[alt]', $article->signature->custom_properties['alt']))->class('text') }}
        @else
          {{ html()->text('image[alt]')->class('text') }}
        @endif
      </div>

      <div class="form-field">
        {{ html()->label('Caption')->for('image[caption]') }}
        @if ($article->signature)
          {{ html()->text('image[caption]', old('image[caption]', $article->signature->custom_properties['caption']))->class('text') }}
        @else
          {{ html()->text('image[caption]')->class('text') }}
        @endif
      </div>

      <figure class="item--image">
        @if ($article->signature)
          <img id="previewer" src="{{ $article->getFirstMediaUrl('signatures') }}" alt="">
        @else
          <img id="previewer" src="{{ asset('images/placeholder/signature.png') }}" alt="">
        @endif
      </figure>
    </fieldset>--}}
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

        @error('status')
          <x-shared.message type="error" context="status" :message="$errors"/>
        @enderror
      </div>

      <div class="form-field promoted">
        {{ html()->label('Featured?')->for('promoted') }}
        <select name="promoted" id="promoted" class="select">
          @foreach(Promoted::cases() as $promoted)
            <option value="{{ $promoted->value }}">{{ $promoted->name }}</option>
          @endforeach
        </select>

        @error('promoted')
          <x-shared.message type="error" context="promoted" :message="$errors"/>
        @enderror
      </div>
    </fieldset>

    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>
      <div class="form-field">
        {{ html()->button('Save Article')->class('button submit') }}
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

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

<x-aenginus.layout title="Edit Article" page="edit" livewire="true">
  <!-- edit.blade -->

  {{ html()
    ->modelForm($article, 'PUT', '/ae/article/update/' . $article->id)
    ->id('articleForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('id', $article->id) }}
  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="editor--header">
    <h1>
      <i class="fa-solid fa-pen-to-square"></i> {{ $article->title }}</h1>

    <p class="">
      <i class="fa-solid fa-eye"> {{ __('Preview') }}</i> &#160;
      <a rel="external" href="{{ $article->permalink }}" title="{{ __('View live entry') }}">
        {{ $article->slug }}
      </a>
    </p>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>
      <div class="form-field title">
        {{ html()->label('Title')->for('title') }}
        {{ html()->text('title')->attribute('required')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> {{ $article->slug ?? '...' }}</p>
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
        {{ html()
          ->select('category', $categories)
          ->value($article->category_id)
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
          'id' => 'signature_image',
          'class' => 'upload'
        ]) }}
      </div>

      <div class="form-field">
        {{ html()->label('Name')->for('signature_image[label]') }}
        @if ($signature !== null)
          {{ html()->text('signature_image[label]', old('signature_image[label]', $signature->custom_properties['label']))->class('text') }}
        @else
          {{ html()->text('signature_image[label]')->class('text') }}
        @endif
      </div>

      <div class="form-field">
        {{ html()->label('Alt Description')->for('signature_image[alt]') }}
        @if ($signature !== null)
          {{ html()->text('signature_image[alt]', old('signature_image[alt]', $signature->custom_properties['alt']))->class('text') }}
        @else
          {{ html()->text('signature_image[alt]')->class('text') }}
        @endif
      </div>

      <div class="form-field">
        {{ html()->label('Caption')->for('signature_image[caption]') }}
        @if ($signature !== null)
          {{ html()->text('signature_image[caption]', old('signature_image[caption]', $signature->custom_properties['caption']))->class('text') }}
        @else
          {{ html()->text('signature_image[caption]')->class('text') }}
        @endif
      </div>

      <figure class="item--image">
        @if ($article->hasMedia('signatures'))
          <img id="previewer" src="{{ $article->getFirstMediaUrl('signatures') }}" alt="">
        @else
          <img id="previewer" src="{{ asset('images/placeholder/signature.png') }}" alt="">
        @endif
      </figure>
    </fieldset>
  </div>

  <aside class="editor--side">
    <fieldset class="container--meta">
      <legend>{{ __('Meta') }}</legend>

      <div class="form-field status">
        {{ html()->label('Status')->for('status') }}
        <select name="status" id="status" class="select">
          @foreach(Status::cases() as $status)
            <option value="{{ $status->value }}" @if ($article->status && $article->status->value === $status->value) selected @endif>
              {{ $status->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-field promoted">
        {{ html()->label('Featured?')->for('promoted') }}
        <select name="promoted" id="promoted" class="select">
          @foreach(Promoted::cases() as $promoted)
            <option value="{{ $promoted->value }}" @if ($article->promoted && $article->promoted->value === $promoted->value) selected @endif>{{ $promoted->name }}</option>
          @endforeach
        </select>
      </div>
    </fieldset>

    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>
      <div class="form-field">
        {{ html()->button('Save Article')->class('button button--submit') }}
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

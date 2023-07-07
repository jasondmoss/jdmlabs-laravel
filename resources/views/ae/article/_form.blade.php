@php
use App\Article\Application\Controllers as Article;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
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

<header class="editor--header">
  @if ('edit' == $mode)
    <h1><i class="fa-solid fa-pen-to-square"></i> {{ $article->title }}</h1>
    <p class="">
      <i class="fa-solid fa-eye"> {{ __('Preview') }}</i> &#160;
      <a rel="external" href="{{ action(Article\SingleController::class, $article->slug) }}" title="{{ __('View live entry') }}">
        {{ $article->slug }}
      </a>
    </p>
  @else
    <h1>{{ __('Create New Article') }}</h1>
  @endif
</header>

<div class="editor--content">
  <fieldset class="container--content">
    <legend>{{ __('Content') }}</legend>
    <div class="form-field title">
      {{ html()->label('Title')->for('title') }}
      {{ html()->text('title')->class('text')->attribute('required') }}
      <p class="title-slug"><span class="label">{{ __('slug') }}:</span> {{ $article->slug ?? '...' }}</p>
    </div>

    <div class="form-field summary">
      {{ html()->label('Summary')->for('summary') }}
      {{ html()->textarea('summary')->class('textarea summary')->cols(90)->rows(4) }}
    </div>

    <div class="form-field body">
      {{ html()->label('Body')->for('body') }}
      {{ html()->textarea('body')->class('textarea full')->cols(90)->rows(15) }}
    </div>
  </fieldset>

  {{--<fieldset class="container--taxonomy">
    <legend>{{ __('Taxonomy') }}</legend>

    <div class="form-field taxonomy">
      {{ html()->label('Categories')->for('category')->class('sr-only') }}
      <select id="taxonomy" name="categories[]" multiple>
        @foreach (Category::select([ 'id', 'name' ])->get() as $cat)
          <option value="{{ $cat->id }}"{{ array_search($cat->id, array_column($article->categories->toArray(), 'id')) !== false ? ' selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
  </fieldset>--}}

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
        @foreach(Status::cases() as $state)
          <option value="{{ $state->value }}"{{ $article->status == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
        @endforeach
      </select>

      @error('status')
      <x-shared.message type="error" context="status" :message="$errors"/>
      @enderror
    </div>

    <div class="form-field promoted">
      {{ html()->label('Featured?')->for('promoted') }}
      <select name="promoted" id="promoted" class="select">
        @foreach(Promoted::cases() as $state)
          <option value="{{ $state->value }}"{{ $article->promoted == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
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
  <a rel="prev" class="back-link" href="{{ URL::previous() }}"><span class="fa-solid fa-arrow-left mr-6"></span> {{ __('Back to last page') }}
  </a>
</footer>

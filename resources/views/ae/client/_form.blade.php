@php
  use App\Shared\Domain\Enums\Promoted;
  use App\Shared\Domain\Enums\Status;
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

<header class="editor--header">
  <h1>
    <i class="fa-solid fa-pen-to-square"></i>
    {{ ('create' == $mode) ? __('Create New Client') : $client->title }}
  </h1>
</header>

<div class="editor--content">
  <fieldset class="container--content">
    <legend>{{ __('Content') }}</legend>

    <div class="form-field title">
      {{ html()->label('Name')->for('name') }}
      {{ html()->text('name')->class('text')->attribute('required') }}
      <p class="title-slug"><span class="label">{{ __('slug') }}</span> {{ $client->slug ?? '...' }}</p>

      @error('name')
      <x-shared.message type="error" context="name" :message="$errors"/>
      @enderror
    </div>

    <div class="form-field schema">
      {{ html()->label('Schema Itemprop')->for('itemprop') }}
      {{ html()->text('itemprop')->class('text')->attribute('required') }}
      <small>{{ __('See') }}
        <a rel="external" href="https://schema.org/docs/full.html" title="A set of extensible schemas to embed structured data on web pages">Schema.org</a></small>

      @error('itemprop')
      <x-shared.message type="error" context="itemprop" :message="$errors"/>
      @enderror
    </div>

    <div class="form-field website">
      {{ html()->label('Website')->for('website') }}
      {{ html()->input('website')->type('url')->class('text')->attributes([
        'id' => 'website',
        'name' => 'website',
      ])->value(old('website', $client->website)) }}

      @error('website')
      <x-shared.message type="error" context="website" :message="$errors"/>
      @enderror
    </div>

    <div class="form-field summary">
      {{ html()->label('Summary')->for('summary') }}
      {{ html()->textarea('summary')->class('textarea')->cols(90)->rows(4) }}

      @error('summary')
      <x-shared.message type="error" context="summary" :message="$errors"/>
      @enderror
    </div>
  </fieldset>
</div>

<aside class="editor--side">
  <fieldset class="container--meta">
    <legend>{{ __('Meta') }}</legend>

    <div class="form-field status">
      {{ html()->label('Status')->for('status') }}
      <select name="status" id="status" class="select">
        @foreach(Status::cases() as $state)
          <option value="{{ $state->value }}"{{ $client->status->value == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
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
          <option value="{{ $state->value }}"{{ $client->promoted->value == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
        @endforeach
      </select>

      @error('promoted')
      <x-shared.message type="error" context="promoted" :message="$errors"/>
      @enderror
    </div>
  </fieldset>

  <fieldset class="container--actions">
    <legend class="sr-only">{{ __('Form Actions') }}</legend>

    <div class="form-field actions">
      {{ html()->button('Save Client')->class('button submit') }}
    </div>
  </fieldset>
</aside>

<footer class="editor--footer">
  <a rel="prev" class="back-link" href="{{ URL::previous() }}"><span class="fa-solid fa-arrow-left mr-6"></span> {{ __('Back to last page') }}
  </a>
</footer>
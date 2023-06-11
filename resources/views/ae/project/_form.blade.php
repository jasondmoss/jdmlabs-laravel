@php
  use App\Shared\Domain\Enums\Pinned;
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
  <h1>
    <i class="fa-solid fa-pen-to-square"></i>
    {{ ('create' == $mode) ? __('Create New Project') : $project->title }}
  </h1>
</header>

<div class="editor--content">
  <fieldset class="container--content">
    <legend>{{ __('Content') }}</legend>

    <div class="form-field title">
      {{ html()->label('Title')->for('title') }}
      {{ html()->text('title')->class('text')->attribute('required')->placeholder(__('Project name')) }}
      <p class="title-slug"><span class="label">{{ __('slug') }}</span> {{ $project->slug ?? '...' }}</p>
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
      ])->value(old('website', $project->website)) }}
    </div>

    <div class="form-field summary">
      {{ html()->label('Summary')->for('summary') }}
      {{ html()->textarea('summary')->class('textarea')->cols(90)->rows(4)->placeholder(__('An SEO  compatible summary')) }}
    </div>

    <div class="form-field body">
      {{ html()->label('Main Content')->for('body') }}
      {{ html()->textarea('body')->class('textarea')->cols(90)->rows(15)->placeholder(__('Full description of this project')) }}
    </div>
  </fieldset>

  <fieldset class="container--clients">
    <legend>{{ __('Clients') }}</legend>

    <div class="form-field clients">
      {{ html()->label('Client')->for('client_id') }}
      {{ html()->select('client_id', $project->clients)->class('form-control select')->attribute('required')->placeholder('Select a client') }}
    </div>
  </fieldset>

  {{--<fieldset class="container--taxonomy">
    <legend>{{ __('Taxonomy') }}</legend>

    <div class="form-field taxonomy">
      {{ html()->label('Categories')->for('category')->class('sr-only') }}
      <select id="taxonomy" name="categories[]" multiple>
        @foreach (Category::select([ 'id', 'name' ])->get() as $cat)
          <option value="{{ $cat->id }}"{{ array_search($cat->id, array_column($project->categories->toArray(), 'id')) !== false ? ' selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
  </fieldset>--}}

  {{--<fieldset class="container--signature-image">
    <legend>{{ __('Signature Image') }}</legend>
    <div class="form-field">
      {{ html()->label('Image')->for('image')->class('sr-only') }}
      {{ html()->file('image')->accept('jpg,png,svg')->attributes([
        'id' => 'signature_image',
        'class' => 'upload'
      ]) }}
    </div>

    <div class="form-field">
      {{ html()->label('Name')->for('image_label') }}
      @if ($project->signature)
        {{ html()->text('image_label', old('image_label', $project->signature->custom_properties['label']))->class('text') }}
      @else
        {{ html()->text('image_label')->class('text') }}
      @endif
    </div>

    <div class="form-field">
      {{ html()->label('Alt Description')->for('image_alt') }}
      @if ($project->signature)
        {{ html()->text('image_alt', old('image_alt', $project->signature->custom_properties['alt']))->class('text') }}
      @else
        {{ html()->text('image_alt')->class('text') }}
      @endif
    </div>

    <div class="form-field">
      {{ html()->label('Caption')->for('image_caption') }}
      @if ($project->signature)
        {{ html()->text('image_caption', old('image_caption', $project->signature->custom_properties['caption']))->class('text') }}
      @else
        {{ html()->text('image_caption')->class('text') }}
      @endif
    </div>

    <figure class="item--image">
      @if ($project->signature)
        <img id="previewer" src="{{ $project->getFirstMediaUrl('signatures') }}" alt="">
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
          <option value="{{ $state->value }}"{{ $project->status->value == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
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
          <option value="{{ $state->value }}"{{ $project->promoted->value == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
        @endforeach
      </select>

      @error('promoted')
      <x-shared.message type="error" context="promoted" :message="$errors"/>
      @enderror
    </div>

    <div class="form-field pinned">
      {{ html()->label('Pin?')->for('pinned') }}
      <select name="pinned" id="pinned" class="select">
        @foreach(Pinned::cases() as $state)
          <option value="{{ $state->value }}"{{ $project->pinned->value == $state->value ? ' selected'  : '' }}>{{ $state->name }}</option>
        @endforeach
      </select>

      @error('pinned')
      <x-shared.message type="error" context="pinned" :message="$errors"/>
      @enderror
    </div>
  </fieldset>

  <fieldset class="container--actions">
    <legend class="sr-only">{{ __('Form Actions') }}</legend>

    <div class="form-field">
      {{ html()->button('Save Project')->class('button submit') }}
    </div>
  </fieldset>
</aside>

<footer class="editor--footer">
  <a rel="prev" class="back-link" href="{{ URL::previous() }}"><span class="fa-solid fa-arrow-left mr-6"></span> {{ __('Back to last page') }}
  </a>
</footer>

@php
  use App\Client\Interface\Http\Controllers as Client;
  use App\Core\Shared\Enums\Promoted;
  use App\Core\Shared\Enums\Status;
  use App\Project\Interface\Http\Controllers as Project;
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

@push('styles')
  @once
    <style>
.items {
  display: flex;
  flex-direction: column;
  gap: 0.5rem 0;
}

.item {
  display: grid;
  grid-template-columns: 4rem 1fr;
  padding: 0.5rem 0.5rem 1rem;
}

.item dt {
  grid-column: 1;
}

.item dd {
  grid-column: 2;
}
    </style>
  @endonce
@endpush


<x-ae.layout title="Edit Client" page="edit" livewire="true">
  <!-- edit.blade -->

  <x-shared.session />

  {{ html()
    ->modelForm($client, 'PUT', '/ae/client/update/' . $client->id)
    ->id('clientForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}
  {{ html()->hidden('id', $client->id) }}
  {{ html()->hidden('listing_page', URL::previous()) }}

  <header class="editor--header">
    <h1>
      <i class="fa-solid fa-pen-to-square"></i> {{ $client->name }}</h1>

    <p class="">
      <i class="fa-solid fa-eye"> {{ __('Preview') }}</i> &#160;
      <a rel="external" href="{{ action(Client\SingleController::class, $client->slug) }}" title="{{ __('View live entry') }}">
        {{ $client->slug ? $client->slug : '' }}
      </a>
    </p>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>

      <div class="form-field title">
        {{ html()->label('Name')->for('name') }}
        {{ html()->text('name')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> {{ $client->slug ?? '...' }}</p>
      </div>

      <div class="form-field schema">
        {{ html()->label('Schema Itemprop')->for('itemprop') }}
        {{ html()->text('itemprop')->class('text')->attribute('required') }}
        <small>{{ __('See') }}
          <a rel="external" href="https://schema.org/docs/full.html" title="A set of extensible schemas to embed structured data on web pages">Schema.org</a>
        </small>
      </div>

      <div class="form-field website">
        {{ html()->label('Website')->for('website') }}
        {{ html()->input('website')->type('url')->class('text')->attributes([
          'id' => 'website',
          'name' => 'website',
        ])->value(old('website', $client->website)) }}
      </div>

      <div class="form-field summary">
        {{ html()->label('Summary')->for('summary') }}
        {{ html()->textarea('summary')->class('textarea')->rows(4) }}
      </div>
    </fieldset>

    {{-- <fieldset class="container--taxonomy">
      <legend>{{ __('Taxonomy') }}</legend>

      <div class="form-field taxonomy">
        {{ html()->label('Categories')->for('category') }}
        {{ html()->select('category', $categories)->class('form-control select')->placeholder('Choose a category') }}
      </div>
    </fieldset> --}}

    <fieldset class="container--signature-image">
      <legend>{{ __('Business Logo') }}</legend>
      <div class="form-field">
        {{ html()->label('Image')->for('logo_image[file]')->class('sr-only') }}
        {{ html()->file('logo_image[file]')->accept('jpg,png,svg')->attributes([
          'id' => 'logo_image',
          'class' => 'upload'
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
        <img id="previewer" src="{{ asset('images/placeholder/logo.png') }}" alt="">
      </figure>
    </fieldset>

    {{--
      Relationship: Projects
      ..........................................................................
    --}}
    @if (count($client->projects) > 0)
      <fieldset class="container-">
        <legend class="">{{ __('Projects') }}</legend>

        <div class="items">
          @foreach ($client->projects as $project)
            <dl id="Project_{{ $project->id }}" class="item">
              <dt>
                <figure class="item--image">
                  <a href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">
                    {{--@if ($project->hasMedia('signatures'))
                      <img src="{{ $project->getFirstMediaUrl('signatures', 'preview') }}" alt="">
                    @else
                      <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
                    @endif--}}
                    <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
                  </a>
                </figure>
              </dt>
              <dd>
                <h3>
                  <a href="{{ action(Project\EditController::class, $project->id) }}" title="{{ __('Edit') }}">{{ $project->title }}</a>
                </h3>
                <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $project->id }}</p>
              </dd>
            </dl>
          @endforeach
        </div>
      </fieldset>
    @endif
  </div>

  <aside class="editor--side">
    <fieldset class="container--meta">
      <legend>{{ __('Meta') }}</legend>

      <div class="form-field status">
        {{ html()->label('Status')->for('status') }}
        <select name="status" id="status" class="select">
          @foreach (Status::cases() as $state)
            <option value="{{ $state->value }}"{{ $client->status && ($client->status->value == $state->value) ? ' selected'  : '' }}>{{ $state->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-field promoted">
        {{ html()->label('Featured?')->for('promoted') }}
        <select name="promoted" id="promoted" class="select">
          @foreach (Promoted::cases() as $state)
            <option value="{{ $state->value }}"{{ $client->promoted && ($client->promoted->value == $state->value) ? ' selected'  : '' }}>{{ $state->name }}</option>
          @endforeach
        </select>
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
    <a rel="prev" class="back-link" href="{{ URL::previous() }}">
      <span class="fa-solid fa-arrow-left mr-6"></span> {{ __('Back to last page') }}
    </a>
  </footer>

  {{ html()->form()->close() }}
</x-ae.layout>

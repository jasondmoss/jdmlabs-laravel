@php
  use App\Taxonomy\Application\Controllers;
@endphp
<x-ae.layout title="Create New Category" page="create" livewire="true">
  {{ html()
    ->form('POST', '/ae/taxonomy/category/create')
    ->id('categoryForm')
    ->class('content-editor')
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="editor--header">
    <h1>{{ __('Create New CategoryEloquentModel') }}</h1>
  </header>

  <div class="editor--content">
    <fieldset class="container--content">
      <legend>{{ __('Content') }}</legend>
      <div class="form-field title">
        {{ html()->label('Name')->for('name') }}
        {{ html()->text('name')->class('text')->attribute('required') }}
        <p class="title-slug"><span class="label">{{ __('slug') }}:</span> ...</p>
      </div>
    </fieldset>
  </div>

  <aside class="editor--side">
    <fieldset class="container--actions">
      <legend class="sr-only">{{ __('Form Actions') }}</legend>
      <div class="form-field">
        {{ html()->button('Save CategoryEloquentModel')->class('button submit') }}
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

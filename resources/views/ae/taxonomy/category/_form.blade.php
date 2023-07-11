@php
use App\Taxonomy\Category\Application\Controllers;
@endphp
<header class="editor--header">
  @if ('edit' == $mode)
    <h1><i class="fa-solid fa-pen-to-square"></i> {{ $category->name }}</h1>
    <p class="">
      <i class="fa-solid fa-eye"> {{ __('Preview') }}</i> &#160;
      <a rel="external" href="{{--{{ action(Controllers\SingleController::class, $category->slug) }}--}}" title="{{ __('View live entry') }}">
        {{ $category->slug }}
      </a>
    </p>
  @else
    <h1>{{ __('Create New Category') }}</h1>
  @endif
</header>

<div class="editor--content">
  <fieldset class="container--content">
    <legend>{{ __('Content') }}</legend>
    <div class="form-field title">
      {{ html()->label('Name')->for('name') }}
      {{ html()->text('name')->class('text')->attribute('required') }}
      <p class="title-slug"><span class="label">{{ __('slug') }}:</span> {{ $category->slug ?? '...' }}</p>
    </div>
  </fieldset>
</div>

<aside class="editor--side">
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


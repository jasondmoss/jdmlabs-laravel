<figure class="">
  <picture>
    @if ($model->image === null)
     <img src="{{ $model->defaultPlaceholderImage($context) }}" width="400" height="400" alt="{{ __('Placeholder preview image') }}">
    @else
     <img src="{{ $model->getImagePreviewUrl() }}" alt="{{ $model->getImageAlt() }}">
    @endif
  </picture>
</figure>

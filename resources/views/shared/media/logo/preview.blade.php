<figure class="">
  <picture>
    @if ($model->logo === null)
     <img src="{{ $model->getLogoPlaceholderUrl() }}" width="400" height="400" alt="{{ __('Placeholder image') }}">
    @else
     <img src="{{ $model->getLogoPreviewUrl() }}" alt="{{ $model->getLogoAlt() }}">
    @endif
  </picture>
</figure>

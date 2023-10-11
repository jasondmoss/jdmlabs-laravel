<figure class="">
  <picture>
    @if ($model->logo === null)
     <img src="{{ $model->getLogoPlaceholderUrl() }}" width="100" height="100" alt="{{ __('Placeholder image') }}">
    @else
     <img src="{{ $model->getLogoThumbnailUrl() }}" alt="{{ $model->getLogoAlt() }}">
    @endif
  </picture>
</figure>

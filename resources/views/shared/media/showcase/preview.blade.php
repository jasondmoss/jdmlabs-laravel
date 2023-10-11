<figure class="">
  <picture>
    @if ($model->showcase === null)
     <img src="{{ $model->getShowcasePlaceholderUrl() }}" width="400" height="400" alt="{{ __('Placeholder image') }}">
    @else
     <img src="{{ $model->getShowcasePreviewUrl() }}" alt="{{ $model->getShowcaseAlt() }}">
    @endif
  </picture>
</figure>

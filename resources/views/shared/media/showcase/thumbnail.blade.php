<figure class="">
  <picture>
    @if ($model->showcase === null)
     <img src="{{ $model->getShowcasePlaceholderUrl() }}" width="100" height="100" alt="{{ __('Placeholder image') }}">
    @else
     <img src="{{ $model->getShowcaseThumbnailUrl() }}" alt="{{ $model->getShowcaseAlt() }}">
    @endif
  </picture>
</figure>

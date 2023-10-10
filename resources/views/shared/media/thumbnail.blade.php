<figure class="">
  <picture>
    @if ($model->image === null)
     <img src="{{ $model  ->defaultPlaceholderImage('signature') }}" width="100" height="100" alt="">
    @else
     <img src="{{ $model->getImageThumbnailUrl() }}" alt="{{ $model->getImageAlt() }}">
    @endif
  </picture>
</figure>

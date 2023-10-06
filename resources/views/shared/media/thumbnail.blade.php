<figure class="">
  <picture>
    @if ($model->image !== null)
     <img src="{{ $model->getThumbnail() }}" alt="">
    @else
     <img src="{{ $model->defaultPlaceholderImage('signature') }}" width="100" height="100" alt="">
    @endif
  </picture>
</figure>

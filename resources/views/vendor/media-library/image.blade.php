<!-- image.blade -->
{{-- <img{!! $attributeString !!}@if($loadingAttributeValue) loading="{{ $loadingAttributeValue }}"@endif src="{{ $media->getUrl($conversion) }}" alt="{{ $media->name }}"> --}}
<img{!! $attributeString !!}@if($loadingAttributeValue) loading="{{ $loadingAttributeValue }}"@endif src="{{ $media->getUrl($conversion) }}" width="{{ $media->getCustomProperty('width') }}" height="{{ $media->getCustomProperty('height') }}" alt="{{ $media->getCustomProperty('alt') }}">

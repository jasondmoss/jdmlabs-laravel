<!-- responsiveImageWithPlaceholder.blade -->
<?php
$conversion = match ($media->collection_name) {
    'signature' => 'signature_detail',
    'logo' => 'logo_detail',
    'showcase' => 'showcase_detail'
}
?>
<img
  @if($loadingAttributeValue) loading="{{ $loadingAttributeValue }}" @endif
  srcset="{{ $media->getSrcset($conversion) }}"
  src="{{ $media->getUrl($conversion) }}"
  width="{{ $media->getCustomProperty('width') }}"
  height="{{ $media->getCustomProperty('height') }}"
  alt="{{ $media->getCustomProperty('alt') }}"
  {!! $attributeString !!}
>

@foreach ($subcategories as $subcategory)
  <option value="{{ $subcategory->id }}">-- {{ $subcategory->name }}</option>

  {{--@if (count($subcategory->subcategory))
    @include('aenginus.taxonomy.category.parts.option--subcategory', [
      'subcategories' => $subcategory->subcategory
    ])
  @endif--}}
@endforeach

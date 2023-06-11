@if ($term->isLeaf())
  <li class="checkbox-list-item" id="term-{{ $term->id }}">
    {!! Form::taxonomyTermCheckbox($term, $name) !!}
  </li>
@else
  <li class="checkbox-list-heading" id="term-{{ $term->id }}">
    {{$term->name}}
    <ul class="{{ $colClass }} checkbox-sublist" id="list-{{ $term->id }}">
      @foreach ($term->children as $child)
        @include('ae.taxonomy.term.checkbox_list', [
            'term' => $child,
            'name' => $name,
            'colClass' => $colClass
        ])
      @endforeach
    </ul>
  </li>
@endif

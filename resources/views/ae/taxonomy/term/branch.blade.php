<li id="term-{{ $term->id }}">
  <div class="taxonomy-term">
    <div class="drag-handle"><i class="fa-solid fa-up-down-left-right"></i></div>
    <div class="taxonomy-label">{{ $term->name }} {{ $term->id }}</div>
    <div class="taxonomy-actions actions-wrapper" data-model="term" data-id="{{ $term->id }}" data-vocabulary_id="{{ $term->vocabulary_id }}">
      @can('update', $vocabulary)
        <i class="fa-solid fa-pen-to-square"> Edit</i>

        @if ($term->isLeaf())
          <a href="#" class="button" data-confirm="{{ $term->name }}">
            <i class="fa-solid fa-trash"> Delete</i>
          </a>
        @endif
      @endcan
    </div>
  </div>

  <ol id="term-{{ $term->id }}">
    @foreach ($term->children as $child)
      @include('taxonomy::terms.branch', [ 'term' => $child ])
    @endforeach
  </ol>
</li>

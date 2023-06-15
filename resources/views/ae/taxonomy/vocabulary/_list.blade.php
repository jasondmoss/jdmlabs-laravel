<div class="listing-wrapper">
  <nav class="listing-tools">
    {{--<a href="{{ route('admin.taxonomy.create') }}">Create New Taxonomy</a>--}}

    <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
      <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
  </nav>
  @if ($vocabularies->count())
    <dl class="listing">
      @foreach ($vocabularies as $vocabulary)
        <dt>{{ $vocabulary->name }}</dt>
        @if ( $vocabulary->terms->count() > 0)
          <dd>
            @foreach ($vocabulary->rootTerms() as $term)
              <span>{{ $term->name }}</span>{{ $loop->last ? '' : ',' }}
              {{--@include('Term::branch', [ 'term' => $term ])--}}
            @endforeach
          </dd>
        @endif
        <dd>{{ $vocabulary->description }}</dd>
      @endforeach
    </dl>
    {{-- Pagination. --}}
    {{ $vocabularies->links() }}
  @else
    <div class="w-full mt-8 p-20">
      <strong>No taxonomies found.</strong>
    </div>
  @endif
</div>

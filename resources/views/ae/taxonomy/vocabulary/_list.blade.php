{{--@php
  use App\Shared\Domain\Enums\Promoted;
  use App\Shared\Domain\Enums\Status;
@endphp--}}
<div class="listing-wrapper">
  <nav class="listing-tools">
    {{--<a href="{{ route('admin.taxonomy.create') }}">Create New Taxonomy</a>--}}

    <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
      <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
  </nav>
  @if ($taxes->count())
    <div class="listing">
      @foreach ($taxes as $tax)
        {{ dd($tax) }}
      @endforeach
    </div>
    {{-- Pagination. --}}
    {{ $taxes->links() }}
  @else
    <div class="w-full mt-8 p-20">
      <strong>No taxonomies found.</strong>
    </div>
  @endif
</div>

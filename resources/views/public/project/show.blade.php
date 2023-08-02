<x-public.layout title="Projects" page="index" schema="CollectionPage" type="page listing" livewire="true">
  <header class="">
    <h1>{{ __('Projects') }}</h1>
  </header>

  <div class="listings project">
    @if ($projects->count())
      <livewire:project.published-projects/>
    @else
      <div class="">
        <strong>No matches found.</strong>
      </div>
    @endif
  </div>
</x-public.layout>

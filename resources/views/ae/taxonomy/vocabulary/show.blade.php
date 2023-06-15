<x-ae.layout title="Taxonomy" page="index" livewire="true">
  <header class="panel-header">
    <h1>{{ __('Taxonomy') }}</h1>
  </header>

  @if (session('error') or session('create') or session('update') or session('delete'))
    @if (session('error'))
      <x-shared.message type="error" context="error" :message="session('errors')" />
    @elseif (session('create'))
      <x-shared.message type="status" context="create" :message="session('create')" />
    @elseif (session('update'))
      <x-shared.message type="status" context="update" :message="session('update')" />
    @elseif (session('delete'))
      <x-shared.message type="status" context="delete" :message="session('delete')" />
    @endif
  @endif

  <livewire:taxonomy.admin-listing />
</x-ae.layout>

<x-ae.layout title="Clients" page="index" livewire="true">
  <header class="panel-header">
    <h1>{{ __('Clients') }}</h1>
  </header>

  @if (session('errors') or session('create') or session('update') or session('delete'))
    @if (session('errors'))
      <x-shared.message type="error" context="error" :message="session('errors')" />
    @elseif (session('create'))
      <x-shared.message type="status" context="create" :message="session('create')" />
    @elseif (session('update'))
      <x-shared.message type="status" context="update" :message="session('update')" />
    @elseif (session('delete'))
      <x-shared.message type="status" context="delete" :message="session('delete')" />
    @endif
  @endif

  <livewire:client.admin-listing />
</x-ae.layout>

<x-ae.layout title="Clients" page="index" livewire="true">
  <header class="panel-header">
    <h1>{{ __('Clients') }}</h1>
  </header>

  @if (session('create') or session('update') or session('delete'))
    @if (session('create'))
      <x-shared.message class="status create" :message="session('status')" />
    @elseif (session('update'))
      <x-shared.message class="status update" :message="session('status')" />
    @elseif (session('delete'))
      <x-shared.message class="status delete" :message="session('status')" />
    @endif
  @endif

  <livewire:client.admin-listing />
</x-ae.layout>

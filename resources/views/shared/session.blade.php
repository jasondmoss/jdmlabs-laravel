<!-- session.blade -->
@if (session('errors') || session('create') || session('update') || session('delete'))
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

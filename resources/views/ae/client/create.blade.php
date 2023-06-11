<x-ae.layout title="Create New Client" page="create" livewire="true">
  {{ html()
    ->form('POST', '/ae/client/create')
    ->id('clientForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    @include('ae.client._form', [
      'client' => $client,
      'mode' => 'create'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

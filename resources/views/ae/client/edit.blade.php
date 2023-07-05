<x-ae.layout title="Edit Client" page="edit" livewire="true">
  {{ html()
    ->modelForm($client, 'PUT', '/ae/client/update/' . $client->id)
    ->id('clientForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    {{ html()->hidden('listing_page', URL::previous()) }}
    @include('ae.client._form', [
      'client' => $client,
      'mode' => 'edit'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

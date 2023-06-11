<x-ae.layout title="Create New Project" page="create" livewire="true">
  {{ html()->form('POST', '/ae/project/create')
    ->id('projectForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    @include('ae.project._form', [
      'project' => $project,
      'mode' => 'create'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

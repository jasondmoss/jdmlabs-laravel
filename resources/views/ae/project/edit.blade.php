<x-ae.layout title="Edit Project" page="edit" livewire="true">
  {{ html()
    ->modelForm($project, 'PUT', '/ae/project/update/' . $project->id)
    ->id('projectForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    @include('ae.project._form', [
      'project' => $project,
      'mode' => 'edit'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

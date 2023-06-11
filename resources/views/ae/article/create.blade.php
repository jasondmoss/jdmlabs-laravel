<x-ae.layout title="Create New Article" page="create" livewire="true">
  {{ html()
    ->form('POST', '/ae/article/create')
    ->id('articleForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    @include('ae.article._form', [
      'article' => $article,
      'mode' => 'create'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

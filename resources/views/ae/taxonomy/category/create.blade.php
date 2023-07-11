<x-ae.layout title="Create New Category" page="create" livewire="true">
  {{ html()
    ->form('POST', '/ae/taxonomy/category/create')
    ->id('categoryForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    @include('ae.taxonomy.category._form', [
      'category' => $category,
      'categories' => $categories,
      'mode' => 'create'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

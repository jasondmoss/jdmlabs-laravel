<x-ae.layout title="Edit Category" page="edit" livewire="true">
  {{ html()
    ->modelForm($category, 'PUT', '/ae/taxonomy/category/update/' . $category->id)
    ->id('categoryForm')
    ->class('content-editor')
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    {{ html()->hidden('listing_page', URL::previous()) }}
    @include('ae.taxonomy.category._form', [
      'category' => $category,
      'mode' => 'edit'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

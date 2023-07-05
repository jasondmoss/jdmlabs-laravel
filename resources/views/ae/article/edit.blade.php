<x-ae.layout title="Edit Article" page="edit" livewire="true">
  {{ html()
    ->modelForm($article, 'PUT', '/ae/article/update/' . $article->id)
    ->id('articleForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}
    {{ html()->hidden('user_id', auth()->user()->id) }}
    {{ html()->hidden('listing_page', URL::previous()) }}
    @include('ae.article._form', [
      'article' => $article,
      'mode' => 'edit'
    ])
  {{ html()->form()->close() }}
</x-ae.layout>

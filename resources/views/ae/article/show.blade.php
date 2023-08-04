@php
  use App\Article\Interface\Http\Controllers as Article;
@endphp

<x-ae.layout title="Articles" page="index" livewire="false">
  <!-- show.blade -->

  <x-shared.session />

  <livewire:article.admin-listing />
</x-ae.layout>

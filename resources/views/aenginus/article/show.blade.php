@php
  use Aenginus\Article\Interface\Web\Controllers as Article;
@endphp

<x-aenginus.layout title="Articles" page="index" livewire="false">
  <!-- show.blade -->

  <x-shared.session />

  <livewire:article-admin-listing />
</x-aenginus.layout>

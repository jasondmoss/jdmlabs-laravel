<x-aenginus.layout
  title="Dashboard"
  page=" dashboard"
  context=" index"
  livewire="true"
>
  <!-- dashboard.blade -->

  <header class="admin--header">
    <h1>{{ __('Dashboard') }}</h1>
  </header>

  <x-shared.session />

  <div class="listing-wrapper">
    <h2>{{ __('Hello') }}, {{ Auth::user()->name }}</h2>
    <p>{{ __('Stuff goes here ...') }}</p>
  </div>

</x-aenginus.layout>

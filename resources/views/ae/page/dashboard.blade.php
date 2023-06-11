<x-ae.layout title="Dashboard" page="index" livewire="true">
  <header class=""><h1>{{ __('Dashboard') }}</h1></header>
  <div class="">
    <h2>{{ __('Hello') }}, {{ Auth::user()->name }}</h2>
    <p>{{ __('Stuff goes here ...') }}</p>
  </div>
</x-ae.layout>

<?php
use function Laravel\Folio\{name};
name('about');
?>
<x-public.layout
  schema="AboutPage"
  title="About"
  page="about"
  context="index"
  livewire="true"
>
  <x-shared.session/>

  <figure itemprop="primaryImageOfPage" itemscope itemtype="https://schema.org/ImageObject" role="group">
    <meta itemprop="url" content="">
    <meta itemprop="width" content="">
    <meta itemprop="height" content="">
    <img itemprop="contentUrl" src="{{ asset('images/placeholder.png') }}" width="1024" height=780"" alt="Placeholder">
  </figure>

  <header>
    <h2 itemprop="headline">About me.</h2>
  </header>

  <div itemprop="mainEntityOfPage">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac posuere ligula. Nunc porttitor purus ac elementum vestibulum. Donec varius orci nec augue porta, non feugiat augue facilisis. Sed finibus urna et facilisis fermentum. Nullam at ipsum at felis tincidunt placerat a ut nunc. Suspendisse eget lacinia turpis. Morbi lacinia metus massa, nec euismod nibh tempus eget.</p>
  </div>

</x-public.layout>

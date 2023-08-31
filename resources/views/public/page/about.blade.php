<?php
use function Laravel\Folio\{name};
name('about');
?>
<x-public.layout
  schema="AboutPage"
  title="About"
  page=" about"
  context=""
  livewire="true"
>
<article itemscope itemtype="https://schema.org/Article" class="h-entry h-as-article">
  <header class="entry--header">
    <h2 itemprop="headline" class="entry--title">About me.</h2>
  </header>
  <div itemprop="mainEntityOfPage" class="entry--content">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac posuere ligula. Nunc porttitor purus ac elementum vestibulum. Donec varius orci nec augue porta, non feugiat augue facilisis. Sed finibus urna et facilisis fermentum. Nullam at ipsum at felis tincidunt placerat a ut nunc. Suspendisse eget lacinia turpis. Morbi lacinia metus massa, nec euismod nibh tempus eget.</p>
  </div>
</article>
</x-public.layout>

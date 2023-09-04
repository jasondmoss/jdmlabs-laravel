<?php
use function Laravel\Folio\{name};
name('now');
?>
<x-public.layout
  schema="ProfilePage"
  title="Now"
  page=" now"
  context=""
  livewire="true"
>
  <x-shared.session/>

  <figure itemprop="primaryImageOfPage" itemscope itemtype="https://schema.org/ImageObject" role="group" class="primary-image">
    <meta itemprop="url" content="">
    <meta itemprop="width" content="">
    <meta itemprop="height" content="">
    {{-- <img itemprop="contentUrl" src="" srcset="" sizes="100vw" width="" height="" alt=""> --}}
    <img itemprop="contentUrl" src="{{ asset('images/placeholder/showcase.png') }}" width="1024" height=780"" alt="Placeholder">
  </figure>

  <header class="entry--header">
    <h2 itemprop="headline">What I am doing NOW.</h2>
  </header>

  <div itemprop="mainEntityOfPage" class="entry--content">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac posuere ligula. Nunc porttitor purus ac elementum vestibulum. Donec varius orci nec augue porta, non feugiat augue facilisis. Sed finibus urna et facilisis fermentum. Nullam at ipsum at felis tincidunt placerat a ut nunc. Suspendisse eget lacinia turpis. Morbi lacinia metus massa, nec euismod nibh tempus eget.</p>
    <ul>
      <li>Morbi ut est eget magna pellentesque congue dictum in velit.</li>
      <li>Vestibulum viverra augue a urna rutrum ornare.</li>
      <li>Donec pharetra metus ut erat mattis convallis in non lorem.</li>
      <li>Pellentesque luctus leo eget malesuada tincidunt.</li>
      <li>Sed ullamcorper erat sit amet tortor vestibulum interdum.</li>
      <li>Donec lacinia nisi et sem placerat, eu malesuada libero eleifend.</li>
      <li>Vestibulum in nibh quis leo sollicitudin malesuada.</li>
      <li>Aenean aliquet ligula in tincidunt lobortis.</li>
      <li>Praesent eleifend odio eu dictum rutrum.</li>
    </ul>
    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut sed risus lectus. Aliquam lobortis mollis risus, ac tempus erat condimentum nec. Phasellus leo turpis, convallis in bibendum eget, volutpat at nibh. Ut lectus orci, vulputate eget mollis non, dapibus vel nulla. Mauris consequat ullamcorper purus, ac tristique mauris dignissim non.</p>
  </div>

</x-public.layout>

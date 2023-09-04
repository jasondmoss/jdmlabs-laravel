<?php
use function Laravel\Folio\{name};
name('home');
?>
<x-public.layout
  schema="WebPage"
  title="Home"
  page=" home"
  context=""
  livewire="true"
>
  <x-shared.session/>

  <figure itemprop="primaryImageOfPage" itemscope itemtype="https://schema.org/ImageObject" role="group" class="site--primary-image" title="Rugged good looks and boyish grin">
    <meta itemprop="url" content="{{ Vite::asset('resources/assets/images/mugshot--525.jpg') }}">
    <meta itemprop="width" content="525">
    <meta itemprop="height" content="525">
    <img itemprop="contentUrl" src="{{ Vite::asset('resources/assets/images/mugshot--525.jpg') }}" srcset="{{ Vite::asset('resources/assets/images/mugshot--525.jpg') }} 525w,{{ Vite::asset('resources/assets/images/mugshot--375.jpg') }} 375w,{{ Vite::asset('resources/assets/images/mugshot--260.jpg') }} 260w" sizes="100vw" width="525" height="525" alt="Mugshot: Jason D. Moss">
  </figure>

  <header class="">
    <h2 itemprop="headline" class="entry--title">Hey there. I'm Jason.</h2>
    <h3>I hand-craft high calibre websites.</h3>
  </header>

  <div class="">
    <p>Or, to be more specific, I plan, develop, implement and maintain modern sites and custom applications: from large multi-tiered sites, small single-page applications, custom APIs, to custom modules and plug-ins.</p>
    <p>I specialize in developing with <a rel="external" href="https://laravel.com/" title="Laravel: The PHP framework for web artisans.">Laravel</a>, <a rel="external" href="https://www.drupal.org/" title="Drupal: Open Source CMS">Drupal</a>, <a rel="external" href="https://craftcms.com/" title="Craft is a CMS that&#39;s laser-focused on doing one thing really, really well: managing content.">Craft CMS</a>, <a rel="external" href="https://b2evolution.net/" title="b2evolution CMS: Content + Community Management System">b2evolution</a>, <a rel="external" href="https://wordpress.org/" title="WordPress: Blog Tool, Publishing Platform, and CMS">WordPress</a> and countless other tools and solutions.</p>
    <p>If you have any questions, concerns or propositions, please, <a itemprop="email" class="u-email" href="mailto:work@jdmlabs.com" title="Send me a note. Don't be shy.">feel free to contact me</a>.</p>
    <p><strong>Compliant.</strong> <strong>Portable.</strong> <strong>Functional.</strong></p>
  </div>

  {{--<section class="container listings feature client">
    <livewire:published-clients />
  </section>--}}

</x-public.layout>

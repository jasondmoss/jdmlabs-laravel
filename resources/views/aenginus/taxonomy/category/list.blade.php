<?php

use Aenginus\Taxonomy\Interface\Web\Controllers as Category;

?>
  <!-- list.blade -->
<div class="listing-wrapper flex flex-col gap-y-10">

  <header id="listingHeader" class="flex flex-col md:flex-row md:justify-between gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:px-4 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-7 xl:pb-6">
    <h1 class="text-center pl-2 text-4xl font-medium">{{ __('Categories') }}</h1>

    <nav class="listing-tools flex items-center gap-x-10">
      <a class="bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm" href="{{ action(Category\CreateController::class) }}">New Category</a>

      <search>
        <form wire:submit="search" wire:model="query" class="flex justify-center w-full px-5 sm:w-auto">
          <label for="search" class="w-full"> <span class="sr-only">{{ __('Search') }}</span>
            <input wire:model.live="search" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black" placeholder="{{ __('Search') }}">
          </label>
        </form>
      </search>
    </nav>
  </header>

  <div class="listing taxonomy category flex flex-col overflow-x-auto">
    @if ($categories->count())
      <table class="flex flex-col gap-y-4 max-w-sm mx-auto mt-10 mb-0 md:table md:max-w-full md:m-0 lg:mt-4 text-left text-sm font-medium">
        <thead class="hidden md:table-header-group border-b dark:border-neutral-500">
          <tr>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Name') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Articles') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Projects') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Actions') }}</th>
          </tr>
        </thead>

        <tbody class="flex flex-col gap-y-10 md:table-row-group w-full">
          @foreach ($categories as $category)
            @php $dash = ''; @endphp

            @include('aenginus.taxonomy.category.parts.table-row--category', compact('category'))

            @if ($category->subcategory)
              @include('aenginus.taxonomy.category.parts.table-row--subcategory', [
                'subcategories' => $category->subcategory
              ])
            @endif
          @endforeach
        </tbody>
      </table>
    @else
      <div class="w-full mt-8 p-20">
        <strong>No articles found.</strong>
      </div>
    @endif
  </div>
</div>

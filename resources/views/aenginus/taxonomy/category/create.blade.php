<x-aenginus.layout
  title="Create New Category"
  page=" taxonomy category"
  context=" create"
  livewire="true"
>
  <!-- create.blade -->

  <x-shared.session/>

  {{ html()
    ->form('POST', '/ae/taxonomy/category/create')
    ->id('entryForm')
    ->class('content-editor flex flex-col relative p-2 lg:flex-row lg:flex-wrap lg:pb-4')
    ->open()
  }}

  {{ html()->hidden('user_id', auth()->user()->id) }}

  <header class="flex flex-col basis-full md:flex-row gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:justify-between md:pt-3 md:pb-4 lg:border-b-0 xl:pt-5 xl:pb-4">
    <h1 class="pl-2 text-4xl font-medium">{{ __('Create New Category') }}</h1>
  </header>

  <div class="flex flex-col gap-y-10 p-2 lg:basis-2/3">
    <fieldset class="flex flex-col gap-y-5 px-2 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Content') }}</legend>

      <div class="flex flex-col gap-y-3">
        {{ html()->label('Name')->for('name')->class('font-medium text-sm') }}
        {{ html()->text('name')->required() }}
        <p><span class="font-bold mr-5">{{ __('slug') }}:</span> ...</p>
      </div>
    </fieldset>
  </div>

  <aside class="lg:basis-1/3 p-2">
    <fieldset class="px-2 py-10 border-t border-gray-300">
      <legend class="mb-5 pr-10 py-5 pl-2 uppercase font-bold text-xl text-gray-500">{{ __('Actions') }}</legend>

      <div class="flex justify-end">
        {{ html()->button('Save Category')->type('submit')->class('form-submit bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm') }}
      </div>
    </fieldset>
  </aside>

  {{ html()->form()->close() }}
</x-aenginus.layout>

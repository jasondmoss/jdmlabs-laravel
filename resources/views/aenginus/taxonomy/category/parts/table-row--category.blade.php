<?php
use Aenginus\Taxonomy\Interface\Web\Controllers as Category;
?>
<!-- Item -->
<tr id="item-{{ $category->id }}" class="taxo-parent flex flex-col max-w-full md:table-row border-b odd:bg-white even:bg-slate-50 hover:bg-lime-50">
  {{--  Name + ID  --}}
  <td class="block md:table-cell md:align-middle md:px-6 py-2">
    <div class="flex flex-col gap-3">
      <a class="font-bold text-base xl:text-xl text-sky-600 hover:text-black" href="{{ action(Category\EditController::class, $category->id) }}" title="{{ __('Edit category') }}">{{ $category->name }}</a>
      <p class="flex gap-x-3" title="{{ __('Category Ulid') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5">
          <path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 00-3.722 1.118.75.75 0 11-.828-1.25 8.25 8.25 0 0112.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 01-1.395-.551A21.69 21.69 0 0018.75 10.5 6.75 6.75 0 0012 3.75zM6.157 5.739a.75.75 0 01.21 1.04A6.715 6.715 0 005.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 01-1.27-.8A6.715 6.715 0 003.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 011.04-.211zM12 7.5a3 3 0 00-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 11-1.112-1.008A10.459 10.459 0 007.5 10.5a4.5 4.5 0 119 0c0 .547-.022 1.09-.067 1.626a.75.75 0 01-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 00-3-3zm0 2.25a.75.75 0 01.75.75A15.69 15.69 0 018.97 20.738a.75.75 0 01-1.14-.975A14.19 14.19 0 0011.25 10.5a.75.75 0 01.75-.75zm3.239 5.183a.75.75 0 01.515.927 19.415 19.415 0 01-2.585 5.544.75.75 0 11-1.243-.84 17.912 17.912 0 002.386-5.116.75.75 0 01.927-.515z" clip-rule="evenodd"/>
        </svg>
        {{ $category->id }}
      </p>
    </div>
  </td>
  {{--  Articles Count  --}}
  <td class="block md:table-cell md:align-middle md:px-6 py-2">{{ $category->articles_count }}</td>
  {{--  Projects Count  --}}
  <td class="block md:table-cell md:align-middle md:px-6 py-2">{{ $category->projects_count }}</td>
  {{--  ACTIONS  --}}
  <td class="block py-2 md:table-cell md:align-middle md:w-32 md:px-6">
    <menu class="flex gap-4">
      <li>
        <i class="fa-solid fa-pen-to-square"></i>
        <a class="text-blue-500" href="{{ action(Category\EditController::class, $category->id) }}" title="{{ __('Edit article') }}">{{ __('Edit') }}</a>
      </li>
      <li>
        <i class="fa-solid fa-trash"></i>
        <a class="text-blue-500" href="{{ action(Category\DestroyController::class, $category->id) }}" onclick="event.preventDefault();document.getElementById('Delete_{{ $category->id }}').submit();" title="{{ __('Delete category') }}">{{ __('Delete') }}</a>
        <form id="Delete_{{ $category->id }}" class="sr-only" method="POST" action="{{ action(Category\DestroyController::class, $category->id) }}">
          @csrf
          {{ method_field('DELETE') }}
          {{ html()->hidden('id', $category->id) }}
          {{ html()->hidden('user_id', auth()->user()->id) }}
        </form>
      </li>
    </menu>
  </td>
</tr>

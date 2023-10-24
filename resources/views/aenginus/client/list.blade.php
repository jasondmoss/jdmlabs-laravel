<?php
  use Aenginus\Client\Interface\Web\Controllers as Client;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Illuminate\Support\Facades\Date;
?>
<!-- list.blade -->
<div class="relative">

  <header id="listingHeader" class="flex flex-col md:flex-row md:justify-between gap-10 align-middle justify-center sticky top-0 z-10 pt-0 pb-4 bg-white border-solid border-b-2 border-slate-200 md:px-4 md:pt-3 md:pb-4 lg:border-b-0 xl:pt-7 xl:pb-6">
    <h1 class="text-center pl-2 text-4xl font-medium">{{ __('Clients') }}</h1>

    <nav class="flex flex-wrap justify-center items-center gap-10 sm:flex-row">
      <a class="bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-200 text-white font-bold py-2 px-4 rounded-sm" href="{{ action(Client\CreateController::class) }}">New Client</a>

      <search>
        <form wire:submit="search" wire:model="query" class="flex justify-center w-full px-5 sm:w-auto">
          <label for="search" class="w-full">
            <span class="sr-only">{{ __('Search') }}</span>
            <input wire:model.live="search" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black" placeholder="{{ __('Search') }}">
          </label>
        </form>
      </search>
    </nav>
  </header>

  <div class="listing client flex flex-col overflow-x-auto">
    @if ($clients->count())
      <table class="flex flex-col gap-y-4 max-w-sm mx-auto mt-10 mb-0 md:table md:max-w-full md:m-0 lg:mt-4 text-left text-sm font-medium">
        <thead class="hidden md:table-header-group border-b dark:border-neutral-500">
          <tr>
            <th scope="col" class="md:w-10 md:px-6 py-2 my-2">{{ __('Thumb') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Name') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Updated') }}</th>
            <th scope="col" class="px-6 py-2 my-2 border-l border-l-slate-200">{{ __('Actions') }}</th>
          </tr>
        </thead>

        <tbody class="flex flex-col gap-y-10 md:table-row-group w-full">
          @foreach ($clients as $client)
            @php $permalink = url('/client/' . $client->slug); @endphp

            <!-- Item -->
            <tr id="item-{{ $client->id }}" class="flex flex-col max-w-full md:table-row border-b odd:bg-white even:bg-slate-50 hover:bg-lime-50">
              <td class="block w-full md:table-cell md:w-10 py-2">
                <a class="block" href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit') }}">
                  <x-shared.media.thumbnail :model="$client" :image="$client->logo" />
                </a>
              </td>
              <td class="block md:table-cell md:align-top md:px-6 py-2"><div class="flex flex-col gap-3">
                <a rel="external" class="font-bold text-base xl:text-xl text-sky-600 hover:text-black" href="{{ $permalink }}" title="{{ __('View client') }}">{{ $client->name }}</a>
                <p class="flex gap-x-3" title="{{ __('Client Ulid') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5"><path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 00-3.722 1.118.75.75 0 11-.828-1.25 8.25 8.25 0 0112.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 01-1.395-.551A21.69 21.69 0 0018.75 10.5 6.75 6.75 0 0012 3.75zM6.157 5.739a.75.75 0 01.21 1.04A6.715 6.715 0 005.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 01-1.27-.8A6.715 6.715 0 003.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 011.04-.211zM12 7.5a3 3 0 00-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 11-1.112-1.008A10.459 10.459 0 007.5 10.5a4.5 4.5 0 119 0c0 .547-.022 1.09-.067 1.626a.75.75 0 01-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 00-3-3zm0 2.25a.75.75 0 01.75.75A15.69 15.69 0 018.97 20.738a.75.75 0 01-1.14-.975A14.19 14.19 0 0011.25 10.5a.75.75 0 01.75-.75zm3.239 5.183a.75.75 0 01.515.927 19.415 19.415 0 01-2.585 5.544.75.75 0 11-1.243-.84 17.912 17.912 0 002.386-5.116.75.75 0 01.927-.515z" clip-rule="evenodd" /></svg>
                  {{ $client->id }}
                </p>
              </div></td>
              <td class="block py-2 md:table-cell md:align-top md:w-32 md:px-6 lg:w-56">
                <time class="flex md:justify-end gap-x-4 pt-1 text-lg lg:text-base" datetime="{{ Date::parse($client->updated_at)->format('c') }}" title="{{ Date::parse($client->updated_at)->format('c') }}">
                  {{ Date::parse($client->updated_at)->format('Y/m/d \\@ H:i:s') }}
                </time>
              </td>
              <td class="block py-2 md:table-cell md:align-top md:w-32 md:px-6">
                <div class="flex gap-3">
                  <span class="status" wire:click="toggleStatePublished('{{ $client->id }}')" title="@if ($client->status->value === 'published') {{ __('Unpublish this client') }} @else {{ __('Publish this client') }} @endif">
                    {!! Status::icon($client->status) !!}
                  </span>
                  <span class="promoted" wire:click="toggleStatePromoted('{{ $client->id }}')" title="@if ($client->promoted->value === 'promoted') {{ __('Unpromote this client') }} @else {{ __('Promote this client') }} @endif">
                    {!! Promoted::icon($client->promoted) !!}
                  </span>
                </div>
                <p class="flex gap-x-3 mt-3" title="{{ __('Assigned projects') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-default mt-0.5"><path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zM12 9.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H12zm-.75-2.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75zM6 12.75a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5H6zm-.75 3.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75zM6 6.75a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-3A.75.75 0 009 6.75H6z" clip-rule="evenodd" /><path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 01-3 0V6.75z" /></svg>
                  {{ $client->projects_count }}
                </p>
                <div x-data="{
                    open: false,
                    toggle() {
                        if (this.open) {
                            return this.close()
                        }
                        this.$refs.button.focus()
                        this.open = true
                    },
                    close(focusAfter) {
                        if (! this.open) {
                            return
                        }
                        this.open = false
                        focusAfter && focusAfter.focus()
                    }
                  }"
                  x-on:keydown.escape.prevent.stop="close($refs.button)"
                  x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                  x-id="['dropdown-button']"
                  class="relative float-right mt-3"
              >
                <div class="inline-flex overflow-hidden rounded-sm divide-x divide-amber-300 border border-amber-300 shadow-md shadow-amber-50">
                  <a class="flex items-center space-x-2 px-4 py-1 bg-amber-100 hover:bg-amber-300 text-center text-sm text-amber-600 hover:text-amber-800"
                      href="{{ action(Client\EditController::class, $client->id) }}"
                      title="{{ __('Edit article') }}"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                      <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                      <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                    </svg>
                    <span>{{ __('Edit') }}</span>
                  </a>
                  <button type="button"
                      x-ref="button"
                      x-on:click="toggle()"
                      :aria-expanded="open"
                      :aria-controls="$id('dropdown-button')"
                      class="flex items-center px-2 py-1 group bg-amber-50 hover:bg-amber-300 text-center text-sm text-secondary-700"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 fill-amber-700 group-hover:text-amber-900">
                      <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
                <div class="absolute right-0 z-10 mt-2 w-32 rounded-sm border border-gray-100 bg-white text-left text-sm drop-shadow-xl"
                    x-ref="panel"
                    x-show="open"
                    x-transition.origin.top.left
                    x-on:click.outside="close($refs.button)"
                    :id="$id('dropdown-button')"
                >
                  <div class="flex flex-col gap-y-1">
                    <a href="{{ action(Client\DestroyController::class, $client->id) }}"
                        onclick="event.preventDefault();document.getElementById('Delete_{{ $client->id }}').submit();"
                        class="flex items-center group w-full rounded-sm px-3 py-2 divide-x divide-slate-300 space-x-3 text-gray-700 hover:bg-red-500 hover:text-white"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:text-white">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                      </svg>
                      <span class="pl-3">{{ __('Delete') }}</span>
                    </a>
                    <form id="Delete_{{ $client->id }}" class="sr-only" method="POST" action="{{ action(Client\DestroyController::class, $client->id) }}">
                      @csrf
                      {{ method_field('DELETE') }}
                      {{ html()->hidden('user_id', auth()->user()->id) }}
                      {{ html()->hidden('id', $client->id) }}
                    </form>
                    <a rel="external" href="{{ $permalink }}" class="flex items-center group w-full rounded-sm px-3 py-2 divide-x divide-slate-300 space-x-3 text-gray-700 hover:bg-lime-500 hover:text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 group-hover:text-white">
                        <path fill-rule="evenodd" d="M15.75 2.25H21a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0V4.81L8.03 17.03a.75.75 0 01-1.06-1.06L19.19 3.75h-3.44a.75.75 0 010-1.5zm-10.5 4.5a1.5 1.5 0 00-1.5 1.5v10.5a1.5 1.5 0 001.5 1.5h10.5a1.5 1.5 0 001.5-1.5V10.5a.75.75 0 011.5 0v8.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V8.25a3 3 0 013-3h8.25a.75.75 0 010 1.5H5.25z" clip-rule="evenodd" />
                      </svg>
                      <span class="pl-3">{{ __('View') }}</span>
                    </a>
                  </div>
                </div>
              </div></td>
            </tr>
            <!-- \Item -->
          @endforeach

        </tbody>

        <tfoot class="block md:table-footer-group">
          <tr>
            <td colspan="4">
              {{ $clients->links() }}
            </td>
          </tr>
        </tfoot>
      </table>
    @else
      <div class="w-full mt-8 p-20">
        <strong>No articles found.</strong>
      </div>
    @endif
  </div>
</div>

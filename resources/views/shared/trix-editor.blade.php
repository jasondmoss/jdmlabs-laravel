<!-- trix-editor.blade -->
@if ($label ?? null)
  <label for="{{ $name }}" class="font-medium text-sm">{{ $label }}</label>
@endif

@php $id = $name . Str::random(8); @endphp

<input id="{{ $id }}" type="hidden" name="{{ $name }}" x-ref="{{ $name }}" value="{{ old($name, $value ?? '') }}">

<div class="relative">
  <trix-editor
    type="{{ $type }}"
    placeholder="{{ $placeholder ?? '' }}"
    input="{{ $id }}"
    class="trix-editor border-gray-300 trix-content"
    :class="{' border-red-500 bg-red-100' : error.length || '{{ $errors->has($name) }}'}"
    x-ref="trix-editor"
    x-on:trix-change="$dispatch('input', event.target.value)"
    x-on:keydown="error.length ? error = '' : ''"
    x-on:trix-initialize="$refs['trix-editor'].classList.add('bg-white', 'shadow-sm', 'p-6');"
    x-on:trix-focus="$refs['trix-editor'].classList.add('focus:shadow-outline', 'focus:border-blue-300')"
  ></trix-editor>

  @isset ($hint)
    <div class="text-sm text-gray-500 my-2 leading-tight help-text">{{ $hint }}</div>
  @endisset

  {{-- <div x-show="error.length > 0">
    <svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 48px; right: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z"/>
    </svg>
    <div class="text-red-600 mt-2 text-sm block leading-tight error-text" x-html="error"></div>
  </div> --}}

  @error($name)
    <svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 48px; right: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z"/>
    </svg>
    <div class="text-red-600 mt-2 text-sm block leading-tight error-text">{{ $message }}</div>
  @enderror
</div>

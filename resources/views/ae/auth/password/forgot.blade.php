<x-public.layout title="Forgot Password" page="forgot" schema="WebPage" type="page forgot" livewire="true">
  <!-- forgot.blade -->

  <h2 class="card-header">{{ __('Reset Password') }}</h2>

  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  {{ html()
    ->form('PUT', '/forgot-password')
    ->id('userPassword')
    ->class('content-editor')
    ->open()
  }}

  <fieldset form="userPassword" class="">
    <legend>{{ __('Forgot Password') }}</legend>
    <div class="form-field email">
      {{ html()->label('E-mail Address')->for('email') }}
      {{ html()->email('email', old('email', Auth::user()->email))->required()->class('email') }}

      @error('email')
        <small class="form--error">{{ $message }}</small>
      @enderror
    </div>
    <div class="form-field actions">
      {{ html()->submit('Send Password Reset Link')->class('button submit') }}
    </div>
  </fieldset>

  {{ html()->form()->close() }}

</x-public.layout>

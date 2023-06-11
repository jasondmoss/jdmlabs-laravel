<x-ae.layout title="Password Confirm" page="confirm" livewire="true">
  <h2 class="">{{ __('Confirm Password') }}</h2>
  <p class="">{{ __('Please confirm your password before continuing.') }}</p>
  {{ html()
    ->form('PUT', '/ae/user/confirm-password')
    ->id('userPassword')
    ->class('content-editor')
    ->open()
  }}
    <fieldset form="userPassword" class="">
      <legend>{{ __('Change Password') }}</legend>
      <div class="form-field password">
        {{ html()->label('Password')->for('password') }}
        {{ html()->password('password')->class('password')->required()->attribute('autocomplete', 'off') }}

        @error('password')
          <small class="form--error">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-field actions">
        {{ html()->submit('Confirm Password')->class('button submit') }}
      </div>
    </fieldset>
  {{ html()->form()->close() }}
</x-ae.layout>

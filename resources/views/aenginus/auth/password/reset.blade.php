<x-aenginus.layout
  title="Password Reset"
  page=" reset"
  context=" auth"
  livewire="true"
>
  <!-- reset.blade -->

  <h2 class="">{{ __('Reset Password') }}</h2>

  {{ html()
    ->form('PUT', '/reset-password')
    ->id('userProfile')
    ->class('content-editor')
    ->open()
  }}
    <fieldset form="userProfile" class="">
      <legend>{{ __('Edit Profile') }}</legend>

      <div class="form-field email">
        {{ html()->label('E-mail Address')->for('email') }}
        {{ html()->email('email', old('email', Auth::user()->email))->required()->attribute('autocomplete', 'email')->class('email') }}

        @error('email')
          <small class="form--error">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-field password">
        {{ html()->label('Password')->for('password') }}
        {{ html()->password('password')->class('password')->required()->attribute('autocomplete', 'new-password') }}

        @error('password')
          <small class="form--error">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-field password">
        {{ html()->label('Confirm New Password')->for('password_confirmation') }}
        {{ html()->password('password_confirmation')->class('password')->required()->attribute('autocomplete', 'new-password') }}

        @error('password_confirmation')
          <small class="form--error">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-field actions">
        {{ html()->submit('Reset Password')->class('button button--submit') }}
      </div>
    </fieldset>
  {{ html()->form()->close() }}
</x-aenginus.layout>

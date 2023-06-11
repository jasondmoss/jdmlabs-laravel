<x-ae.layout title="User Account Management" page="account" livewire="true">
  <header class="flex flex-col mb-16">
    <h1 class="inline-block text-4xl mb-3">{{ __('Account Management') }}</h1>
    <h2 class="inline-block text-2xl">User: {{ Auth::user()->name }}</h2>
  </header>
  <section class="account-details">

    {{--
      User Profile.
      --------------------------------------------------------------------------
    --}}
    {{ html()
      ->form('PUT', '/ae/user/profile-information')
      ->id('userProfile')
      ->class('content-editor')
      ->open()
    }}
      <fieldset form="userProfile" class="">
        <legend>{{ __('Edit Profile') }}</legend>
        <div class="form-field name">
          {{ html()->label('Name')->for('name') }}
          {{ html()->text('name', old('name', Auth::user()->name))->class('name') }}

          @error('name')
            <small class="form--error">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-field email">
          {{ html()->label('E-mail Address')->for('email') }}
          {{ html()->email('email', old('email', Auth::user()->email))->required()->class('email') }}

          @error('email')
            <small class="form--error">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-field actions">
          {{ html()->submit('Update Profile')->class('button submit') }}
        </div>
      </fieldset>
    {{ html()->form()->close() }}


    {{--
      Change Password.
      --------------------------------------------------------------------------
    --}}
    {{ html()
      ->form('PUT', '/ae/user/password')
      ->id('userPassword')
      ->class('content-editor')
      ->open()
    }}
      <fieldset form="userPassword" class="">
        <legend>{{ __('Change Password') }}</legend>
        <div class="form-field password">
          {{ html()->label('Current Password')->for('current_password') }}
          {{ html()->password('current_password')->class('password')->required()->attribute('autocomplete', 'off') }}

          @error('current_password')
            <small class="form--error">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-field password">
          {{ html()->label('New Password')->for('password') }}
          {{ html()->password('password')->class('password')->required()->attribute('autocomplete', 'off') }}

          @error('password')
            <small class="form--error">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-field password">
          {{ html()->label('Confirm New Password')->for('password_confirmation') }}
          {{ html()->password('password_confirmation')->class('password')->required()->attribute('autocomplete', 'off') }}

          @error('password_confirmation')
            <small class="form--error">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-field actions">
          {{ html()->submit('Update Password')->class('button submit') }}
        </div>
      </fieldset>
    {{ html()->form()->close() }}


    {{--
      Two-Factor Authentication.
      --------------------------------------------------------------------------
    --}}

    @if(auth()->user()->two_factor_confirmed)

      <!--
       2FA confirmed, we show a 'disable' button to disable it.
      -->
      {{ html()
        ->form('POST', '/ae/user/two-factor-authentication')
        ->method('delete')
        ->id('2faDisable')
        ->class('content-editor')
        ->open()
      }}
        <fieldset form="2faDisable" class="">
          <legend>{{ __('Two-Factor Authentication') }}</legend>
          <div class="form-field actions">
            {{ html()->submit('Disable 2FA')->class('button submit') }}
          </div>
        </fieldset>
      {{ html()->form()->close() }}

    @elseif(auth()->user()->two_factor_secret)

      <!--
        2FA enabled but not yet confirmed, we show the QRcode and ask for
        confirmation.
      -->
      {{ html()
        ->form('POST', '/ae/user/two-factor-confirm')
        ->id('2faConfirm')
        ->class('content-editor')
        ->open()
      }}
        <fieldset form="2faConfirm" class="">
          <legend>{{ __('Two-Factor Authentication') }}</legend>
          {!! auth()->user()->twoFactorQrCodeSvg() !!}
          <div class="form-field pincode">
            {{ html()->label('Authentication Code')->for('code') }}
            {{ html()->text('code')->class('code')->required()->attribute('autocomplete', 'off') }}
          </div>
          <div class="form-field actions">
            {{ html()->submit('Validate 2FA')->class('button submit') }}
          </div>
        </fieldset>
      {{ html()->form()->close() }}

    @else

      <!--
        2FA not enabled at all, we show an 'enable' button.
      -->
      {{ html()
        ->form('POST', '/ae/user/two-factor-authentication')
        ->id('2faActivate')
        ->class('content-editor')
        ->open()
      }}
        <fieldset form="2faActivate" class="">
          <legend>{{ __('Two-Factor Authentication') }}</legend>
          <div class="form-field actions">
            {{ html()->submit('Activate 2FA')->class('button submit') }}
          </div>
        </fieldset>
      {{ html()->form()->close() }}

    @endif
  </section>
</x-ae.layout>

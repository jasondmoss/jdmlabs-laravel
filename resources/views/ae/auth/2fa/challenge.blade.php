<x-ae.layout title="Two-Factor Challenge" page="challenge" livewire="true">
  <!-- challenge.blade -->

  {{ html()
    ->form('POST', '/ae/user/two-factor-challenge')
    ->id('2faChallenge')
    ->class('content-editor')
    ->open()
  }}
    <fieldset form="2faChallenge" class="">
      <legend>{{ __('2FA Authentication Code') }}</legend>
      {!! auth()->user()->twoFactorQrCodeSvg() !!}
      <div class="form-field pincode">
        {{ html()->label('Authentication Code')->for('code') }}
        {{ html()->text('code')->class('code')->autofocus()->required()->attribute('autocomplete', 'off') }}
      </div>
      <div class="form-field actions">
        {{ html()->submit('Verify')->class('button submit') }}
      </div>
    </fieldset>
  {{ html()->form()->close() }}
  <p class="text-center"><a href="{{route('register')}}">Register</a></p>
</x-ae.layout>

<x-aenginus.layout
  title="Two-Factor Challenge"
  page="two-factor-challenge"
  context="auth"
  livewire="true"
>
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
        {{ html()->submit('Verify')->class('button button--submit') }}
      </div>
    </fieldset>
  {{ html()->form()->close() }}

</x-aenginus.layout>

<x-public.layout title="Email Verification" page="verify" schema="WebPage" type="page verify" livewire="true">
  <!-- verify.blade -->

  <h2 class="">{{ __('Verify Your Email Address') }}</h2>

  @if (session('resent'))
    <div class="alert alert-success" role="alert">
      {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
  @endif

  {{ __('Before proceeding, please check your email for a verification link.') }}
  {{ __('If you did not receive the email') }},

  {{ html()
    ->form('POST', '/ae/email/verification-notification')
    ->id('emailVerify')
    ->class('content-editor')
    ->open()
  }}

  <fieldset form="emailVerify" class="">
    <legend>{{ __('Email Verification') }}</legend>
    <div class="form-field actions">
      {{ html()->submit('Re-Verify')->class('button button--submit') }}
    </div>
  </fieldset>

  {{ html()->form()->close() }}

</x-public.layout>

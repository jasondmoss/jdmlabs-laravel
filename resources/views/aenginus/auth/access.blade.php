<x-public.layout
  schema="WebPage"
  title="Login"
  page=" access"
  context=" auth"
  livewire="false"
>
  <!-- access.blade -->

  {{ html()
    ->form('POST', '/ae/access')
    ->id('loginForm')
    ->class('content-editor')
    ->attribute('autocomplete', 'off')
    ->open()
  }}
  <fieldset>
    <legend>{{ __('Access to Ænginus') }}</legend>

    <div class="form-field email">
      {{ html()->label('E-mail Address')->for('email') }}
      {{ html()->email('email')->required()->class('email') }}

      @error('email')
        <small class="form--error">{{ $message }}</small>
      @enderror
    </div>

    <div class="form-field password">
      {{ html()->label('Password')->for('password') }}
      {{ html()->password('password')->required()->class('password') }}

      @error('password')
        <small class="form--error">{{ $message }}</small>
      @enderror
    </div>

    <div class="form-field remember">
      {{ html()->label('Remember me')->for('remember') }}
      {{ html()->checkbox('remember')->class('remember-me') }}
    </div>

    <div class="form-field actions">
      {{ html()->button('Login')->class('button button--submit') }}
    </div>
  </fieldset>
  {{ html()->form()->close() }}

  <p class=""><a href="{{  route('register') }}">{{ __('Register') }}</a></p>

</x-public.layout>

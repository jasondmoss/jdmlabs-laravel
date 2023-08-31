<x-public.layout
  schema="WebPage"
  title="Register"
  page=" register"
  context=" auth"
  livewire="false"
>
  <!-- register.blade -->

  {{ html()
    ->form('POST', '/ae/register')
    ->id('registerForm')
    ->class('content-editor')
    ->acceptsFiles()
    ->open()
  }}

  <div class="form-field">
    {{ html()->label('Full Name')->for('name') }}
    {{ html()->text('name')->required()->class('text') }}

    @error('name')
    <small class="form--error">{{ $message }}</small>
    @enderror
  </div>

  <div class="form-field">
    {{ html()->label('E-mail Address')->for('email') }}
    {{ html()->email('email')->required()->class('email') }}

    @error('email')
    <small class="form--error">{{ $message }}</small>
    @enderror
  </div>

  <div class="form-field">
    {{ html()->label('Password')->for('password') }}
    {{ html()->password('password')->required()->class('password') }}

    @error('password')
    <small class="form--error">{{ $message }}</small>
    @enderror

    {{ html()->label('Confirm Password')->for('password_confirmation') }}
    {{ html()->password('password_confirmation')->required()->class('password') }}

    @error('password_confirmation')
    <small class="form--error">{{ $message }}</small>
    @enderror
  </div>

  <div class="form-field actions">
    {{ html()->button('Register')->class('button button--submit') }}
  </div>

  {{ html()->form()->close() }}

  <p class=""><a href="{{route('access')}}">{{ __('Login') }}</a></p>

</x-public.layout>

@extends('Theme::layouts.settings')

@section('page:title', __('Branding'))
@section('form:title', __('Email Options'))

@section('form:content')
  <p class="form-label text-uppercase text-muted mb-4">{{ __('Sender') }}</p>
  @field('input', ['name' => 'MAIL_FROM_NAME', 'label' => __('From Name'), 'value' => settings('MAIL_FROM_NAME')])
  @field('input', ['name' => 'MAIL_FROM_ADDRESS', 'label' => __('From Email Address'), 'value' => settings('MAIL_FROM_ADDRESS')])

  <p class="form-label text-uppercase text-muted mt-5 mb-4">{{ __('Mail Setup') }}</p>

  @field('input', ['name' => 'MAIL_DRIVER', 'label' => __('Driver'), 'value' => settings('MAIL_DRIVER')])
  @field('input', ['name' => 'MAIL_HOST', 'label' => __('Host'), 'value' => settings('MAIL_HOST')])
  @field('input', ['name' => 'MAIL_PORT', 'label' => __('Port'), 'value' => settings('MAIL_PORT')])
  @field('input', ['name' => 'MAIL_USERNAME', 'label' => __('Username'), 'value' => settings('MAIL_USERNAME')])
  @field('input', ['name' => 'MAIL_PASSWORD', 'label' => __('Password'), 'value' => settings('MAIL_PASSWORD'), 'type' => 'password'])
  @field('input', ['name' => 'MAIL_ENCRYPTION', 'label' => __('Encryption'), 'value' => settings('MAIL_ENCRYPTION')])
@endsection

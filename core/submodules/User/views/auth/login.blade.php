@extends('Theme::layouts.auth')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-login mx-auto">
        <div class="text-center mb-2">
          <img class="brand-img brand-img-shadow img-inverted" src="{{ $application->site->logo }}" alt="{{ $application->site->title }}" width="100" height="auto">
          <h1 class="text-white brand-title brand-title-shadow">{{ $application->site->title }}</h1>
        </div>
        <form class="card" action="{{ route('login.login') }}" method="POST">
          {{ csrf_field() }}
          <div class="card-body p-6">
            <div class="card-title">{{ __("Sign in with your {$application->site->title} account") }}</div>
            <div class="form-group">
              <label class="form-label">{{ __('Email or username') }}</label>
              <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" aria-describedby="emailHelp" placeholder="{{ __('Type email or username') }}" value="{{ old('username') }}">
              @if ($errors->has('username'))
                <div class="invalid-feedback">{{ __($errors->first('username')) }}</div>
              @endif
            </div>
            <div class="form-group">
              <label class="form-label">
                {{ __('Password') }}
              </label>
              <input type="password" name="password" class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
              @if ($errors->has('password'))
                <div class="invalid-feedback">{{ __($errors->first('password')) }}</div>
              @endif
              <a href="{{ route('password.forgot') }}" class="float-right small">{{ __('Forgot password?') }}</a>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary btn-block">{{ __('Sign in') }}</button>
            </div>
            <div class="form-group mt-2 mb-5">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" checked value="1" class="custom-control-input">
                <span class="custom-control-label">{{ __('Remember me') }}</span>
              </label>
            </div>
            <div class="text-left text-muted small">
              <small>{{ __("Don't have account yet?") }} <a href="{{ route('register.show') }}">{{ __('Sign up') }}</a></small>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

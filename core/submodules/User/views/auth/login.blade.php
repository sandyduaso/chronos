@extends('Theme::layouts.auth')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-login mx-auto">
        <form class="card mt-6" action="{{ route('login.login') }}" method="POST">
          {{ csrf_field() }}
          <div class="card-body p-6">
            @include('Theme::partials.brand', ['color' => 'text-primary'])
            <div class="card-title mt-1">{{ __("Sign in with your {$application->site->title} account") }}</div>
            <div class="form-group">
              <label class="form-label">{{ __('Email or username') }}</label>
              <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" aria-describedby="emailHelp" placeholder="{{ __('Type email or username') }}" value="{{ old('username') }}">
              @include('Theme::errors.span', ['field' => 'username'])
            </div>
            <div class="form-group">
              <label class="form-label">
                {{ __('Password') }}
              </label>
              <input type="password" name="password" class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
              @include('Theme::errors.span', ['field' => 'password'])
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

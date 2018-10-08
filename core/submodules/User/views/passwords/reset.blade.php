@extends("Theme::layouts.auth")

@section("head-title", __("Setup New Password | {$application->site->title}"))

@section("main")
  <v-jumbotron height="100vh">
    <v-container fluid fill-height>
      <v-layout row wrap justify-center>
        <v-flex lg6 sm8 xs12 justify-center>

          @include("Theme::partials.banner")

          <v-card flat color="transparent" class="mt-5">
            <v-card-title class="headline" v-html="trans('Setup New Password')"></v-card-title>
            <v-card-text>
              <p class="subheading">@{{ trans("Please provide your registered email address and new password.") }}</p>

              <v-form action="{{ route('password.reset') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <v-text-field solo name="email" hide-details prepend-icon="email" :placeholder="trans('Email')" class="mb-3" type="email" value="{{ old('email') }}"></v-text-field>
                @if ($errors->has('email'))
                  <div class="mb-3 caption error--text">{{ $errors->first('email') }}</div>
                @endif

                <v-text-field solo name="password" hide-details prepend-icon="lock" :placeholder="trans('New Password')" class="mb-3" type="password" value="{{ old('password') }}"></v-text-field>
                @if ($errors->has('password'))
                  <div class="mb-3 caption error--text">{{ $errors->first('password') }}</div>
                @endif

                <v-text-field solo name="password_confirmation" hide-details prepend-icon="lock" :placeholder="trans('Confirm Password')" class="mb-3" type="password" value="{{ old('password_confirmation') }}"></v-text-field>
                @if ($errors->has('password_confirmation'))
                  <div class="mb-3 caption error--text">{{ $errors->first('password_confirmation') }}</div>
                @endif

                <div>
                  <v-btn large type="submit" class="ma-0" color="primary">@{{ trans("Reset Password") }}</v-btn>
                </div>
              </v-form>
            </v-card-text>
          </v-card>

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection

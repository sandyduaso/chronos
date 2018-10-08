@extends("Theme::layouts.auth")

@push('before-content')
  @include("Theme::partials.navigationbar")
@endpush

@section("main")
  <v-container fluid>
    <v-layout row wrap justify-center>
      <v-flex lg6 sm8 xs12 justify-center>

        @include("Theme::partials.banner")

        <v-form action="{{ route('password.send') }}" method="POST">
          {{ csrf_field() }}
          <v-card flat color="transparent">
            <v-card-title class="headline" v-html="trans('Forgot your password?')"></v-card-title>
            <v-card-text>
              <p class="subheading">@{{ trans("Don't worry. Resetting your password is easy, just tell us the email address you registered with us.") }}</p>

              <v-text-field v-title v-focus solo name="email" hide-details prepend-icon="email" :placeholder="trans('email@domain.com')" class="mb-3" type="email"></v-text-field>

              @if ($errors->has('email'))
                <div class="mb-3 caption error--text">{{ $errors->first('email') }}</div>
              @endif
            </v-card-text>
            <v-card-actions>
              <v-btn large type="submit" color="primary">@{{ trans("Send Reset Link") }}</v-btn>
              <v-btn large href="{{ route('register.show') }}">@{{ trans("Sign up") }}</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>

      </v-flex>
    </v-layout>
  </v-container>
@endsection

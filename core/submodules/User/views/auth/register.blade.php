@extends("Theme::layouts.auth")

@section("main")
  {{-- @parent --}}
  <v-jumbotron :gradient="`to top right, #022242 10%, #420224 100%`" height="100%">
    <v-container fluid fill-height>
      <v-layout row wrap align-center justify-center>
        <v-flex lg3 md4 sm8 xs12>

          <v-slide-y-transition mode="in-out">
            <register-card
              color="primary"
              height="100%"
              logo="{{ $application->site->logo }}"
              {{-- subtitle="{{ $application->site->tagline }}" --}}
              title="{{ __('Create an account') }}"
            ></register-card>
          </v-slide-y-transition>
          <p class="white--text body-2 mt-2">
            {{ __('Already have an account?') }}
            <a href="{{ route('login.show') }}">{{ __('Login here.') }}</a>
          </p>

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection

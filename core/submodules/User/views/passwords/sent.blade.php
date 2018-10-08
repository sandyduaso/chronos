@extends("Theme::layouts.auth")

@section("main")
  <v-jumbotron height="100vh">
    <v-container fluid fill-height>
      <v-layout row wrap justify-center>
        <v-flex lg6 sm8 xs12 justify-center>

          @include("Theme::partials.banner")

          <v-card flat color="transparent" class="mt-5">
            <v-card-title class="headline" v-html="trans('Password Reset Link Sent')"></v-card-title>
            <v-card-text>
              <p class="subheading mb-4">@{{ trans("We have sent a password reset link to your email. Please click the reset password link to set your new password.") }}</p>

              <p>@{{ trans("Didn't receive the email yet?") }}</p>
              <p>@{{ trans("Please check your spam folder, or ") }} <a href="{{ route('password.request') }}">{{ __('resend') }}</a> the email.</p>

              <p class="grey--text caption" v-html="trans('You may close this window now.')"></p>
            </v-card-text>
          </v-card>

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection

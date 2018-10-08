@extends("Theme::layouts.auth")

@section("content")
    <v-container>
        <v-layout row wrap>
            <v-flex xs12 md8 offset-md2>
                <v-toolbar class="transparent elevation-0"></v-toolbar>
                <v-card class="text-xs-center">
                    <v-card-text class="grey lighten-4 elevation-0">
                        <img width="150" src="{{ assets('frontier/images/auth/green-check.png') }}" alt="{{ __('Thank you') }}">
                    </v-card-text>
                    <v-card-text>
                        <h1 class="display-2 success--text">{{ __('Thank You') }}</h1>
                        <v-flex xs6 offset-xs3>
                            <p class="subheading grey--text text--darken-1">{{ __("A confirmation letter is on its way to your inbox. Follow the instructions provided there to continue.") }}</p>
                            <p class="subheading grey--text text--darken-1">{{ __("Meanwhile, you can login") }} <a href="{{ route('login.show') }}">{{ 'here.' }}</a></p>

                            {{-- <v-divider class="mt-2 mb-3"></v-divider> --}}

                            {{-- <p class="grey--text text--darken-1">{{ __("If within 30 minutes you haven't received the email, you can request for another by clicking the button below.") }}</p> --}}
                            {{-- {{ route('public.show', '#') }} --}}
                            {{-- <v-btn flat href="#">{{ __('Request Verification Email Again') }}</v-btn> --}}
                            {{-- <p class="grey--text text--darken-1">{{ __("You may also request for verification when you login in Settings > Profile > Verification") }}</p> --}}
                        </v-flex>
                    </v-card-text>
                </v-card>
                <div class="text-xs-center mt-2">
                    <small class="grey--text">{{ __($application->site->copyright) }}</small>
                </div>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

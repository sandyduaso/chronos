@extends("Theme::layouts.auth")

@section("content")
        <main id="main" class="main">
            <v-container fluid fill-height>
                <v-layout row wrap justify-center align-center>
                    <v-flex lg3 md4 sm8 xs12 justify-center align-center>

                        @include("Theme::partials.banner")

                        <v-card class="elevation-5 mb-1">
                            <form action="{{ route('login.login') }}" method="POST">
                                {{ csrf_field() }}
                                <v-card transition="slide-x-transition">
                                    <v-card-text class="text-xs-center">
                                        <img class="mb-3" src="{{ $application->site->logo }}" width="100px" alt="{{ $application->site->title }}">
                                        <h4 class="title page-title"><strong>{{ $application->site->title }}</strong></h4>
                                        <p class="page-title">{{ __($application->site->tagline) }}</p>
                                    </v-card-text>
                                    <v-card-text class="pa-4 text-xs-center">
                                        <v-text-field
                                            :error-messages="resource.errors.username"
                                            class="input-group"
                                            label="{{ __('Email or username') }}"
                                            name="username"
                                            value="{{ old('username') }}"
                                        ></v-text-field>
                                        <v-text-field
                                            :append-icon-cb="() => (resource.visible = !resource.visible)"
                                            :append-icon="resource.visible ? 'visibility' : 'visibility_off'"
                                            :error-messages="resource.errors.password"
                                            :type="resource.visible ? 'text': 'password'"
                                            class="input-group"
                                            label="{{ __('Password') }}"
                                            min="6"
                                            name="password"
                                            value="{{ old('password') }}"
                                        ></v-text-field>

                                        {{-- Log in --}}
                                        <v-btn secondary block large role="button" class="elevation-1 mx-0" type="submit">{{ __("Login") }}</v-btn>
                                        {{-- / Log in --}}
                                        <v-checkbox
                                            :checked="resource.remember"
                                            label="Remember Me"
                                            light
                                            class="mb-3 pt-0"
                                            color="secondary"
                                            hide-details
                                            v-model="resource.remember"
                                            @click="() => {resource.remember = !resource.remember}"
                                        ></v-checkbox>
                                        <input v-if="resource.remember" type="hidden" name="remember" value="true">

                                        <v-card-actions class="px-0">
                                            <a class="td-n grey--text" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                                            <v-spacer></v-spacer>
                                            <a class="td-n grey--text" href="{{ route('register.show') }}">{{ __('Create Account') }}</a>
                                        </v-card-actions>
                                    </v-card-text>
                                </v-card>
                            </form>

                            @stack('post-login')
                        </v-card>
                        <v-card-actions class="px-0">
                            <v-spacer></v-spacer>
                            <small class="white--text">{{ __($application->site->copyright) }}</small>
                        </v-card-actions>
                    </v-flex>
                </v-layout>
            </v-container>
        </main>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    settings: {},
                    resource: {
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        item: [],
                        model: false,
                        remember: true,
                        visible: false,
                    },
                };
            },
        });
    </script>
@endpush


@push('css')
    <style>
        .application--light {
            background: linear-gradient(45deg, #4B2E75 0%, #C63B5A 100%) !important;
        }
    </style>
@endpush

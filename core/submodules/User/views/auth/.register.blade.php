@extends("Theme::layouts.auth")

@section("content")
    <v-card flat class="accent" height="100vh">
        {{-- <div class="red" style="height: 3px;"></div> --}}
        <v-toolbar class="accent elevation-0" extended></v-toolbar>
        <v-layout>
            <v-flex md6 hidden-sm-and-down>
                <v-container fluid class="white--text text-xs-center">
                    <v-layout row wrap>
                        <v-flex style="text-shadow: 0 1px 1px rgba(0,0,0,0.3)">
                            {{-- <img class="brand-logo" width="200" avatar src="{{ $application->site->logo }}" alt="{{ $application->site->title }}"> --}}
                            <img title="replace image" src="{{ $application->site->logo }}" width="200">
                            <h1 class="display-3 white--text page-title"><strong>{{ __('Welcome, ') }}{{ $application->site->title }}</strong></h1>
                            <p class="page-title headline">Replace this image! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae obcaecati ex ut vel ducimus, officiis et sapiente enim vitae suscipit, at modi minima asperiores nam ipsa non esse corporis molestiae.</p>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
            <v-flex xs10 sm5 md4 offset-xs1>

                @include("Theme::partials.banner")

                <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="slide-x-transition">
                    <v-toolbar card class="white text-xs-center" prominent>
                        <v-spacer v-if="settings && settings.logo_is_centered"></v-spacer>
                        <v-toolbar-title class="brand-type accent--text">{{ __($application->page->title) }} <span class="grey--text">| {{ __($application->site->title) }}</span></v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-container fluid>
                        <form method="POST" action="{{ route('register.register') }}">
                            {{ csrf_field() }}
                            <v-text-field
                                :error-messages="resource.errors.email"
                                class="input-group"
                                label="Email"
                                name="email"
                                type="email"
                                hide-details
                                value="{{ old('email') }}"
                            ></v-text-field>
                            <v-text-field
                                :append-icon-cb="() => (resource.visible = !resource.visible)"
                                :append-icon="resource.visible ? 'visibility' : 'visibility_off'"
                                :error-messages="resource.errors.password"
                                :type="resource.visible ? 'text': 'password'"
                                class="input-group"
                                label="Password"
                                hide-details
                                min="6"
                                name="password"
                                value="{{ old('password') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.password_confirmation"
                                :type="resource.visible ? 'text': 'password'"
                                class="input-group"
                                label="Confirm Password"
                                hide-details
                                min="6"
                                name="password_confirmation"
                                value="{{ old('password_confirmation') }}"
                            ></v-text-field>

                            <v-checkbox
                                :error-messages="resource.errors.terms_and_conditions"
                                :checked="resource.terms_and_conditions"
                                label="{{ __('Agree to our Terms and Conditions') }}"
                                light
                                hide-details
                                v-model="resource.terms_and_conditions"
                                @click="() => {resource.terms_and_conditions = !resource.terms_and_conditions}"
                            >
                            </v-checkbox>
                            <input v-if="resource.terms_and_conditions" type="hidden" name="terms_and_conditions" :value="resource.terms_and_conditions">

                            <v-card-actions>
                                {{-- <v-spacer></v-spacer> --}}
                                <v-btn class="ma-0 blue darken-1 white--text" type="submit">{{ __("Register") }}</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </form>

                        {{-- Template --}}
                        <template inline-template>
                            <div class="hr">
                                <strong class="hr-text grey--text text--lighten-2">or</strong>
                            </div>
                            <v-layout>
                                <v-flex md6 class="text-xs-center">
                                    <v-btn block class="grey--text elevation-0">
                                        <i class="fa fa-google">&nbsp;</i>
                                        Google
                                    </v-btn>
                                </v-flex>
                                <v-flex md6 class="text-xs-center">
                                    <v-spacer></v-spacer>
                                    <v-btn block class="grey--text elevation-0">
                                        <i class="fa fa-facebook">&nbsp;</i>
                                        Facebook
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </template>
                        {{-- /Template --}}
                    </v-container>

                    <v-divider></v-divider>

                    <v-card-actions class="pa-3">
                        <a role="button" href="{{ route('login.show') }}">{{ __('Have an Account? Login here.') }}</a>
                        <v-spacer></v-spacer>
                        {{-- {{ route('pages.single', 'terms-and-conditions') }} --}}
                        <a target="_blank" role="button" href="#">{{ __('Terms and Conditions') }}</a>
                    </v-card-actions>
                </v-card>

                @stack('post-login')

                <div class="text-xs-center mt-1 mb-4">
                    <small class="white--text">{{ __($application->site->copyright) }}</small>
                </div>

            </v-flex>
        </v-layout>
    </v-card>

@endsection

@push('post-css')
    <style>
        .card--flex-toolbar--stylized {
            margin-top: -65px;
        }
        .card--flex-toolbar--stylized{margin-top:-64px}.hr{text-align:center;position:relative}.hr:after,.hr:before{content:"";display:block;width:40%;height:1px;margin:2px 1rem;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background-color:rgba(0,0,0,.15)}.hr:after{text-align:left;position:absolute;left:0}.hr:before{position:absolute;text-align:right;right:0}[class*=application-] .color--google:hover{background-color:#db3236;color:#fff}[class*=application-] .color--facebook:hover{background-color:#3a589e;color:#fff}
        /*# sourceMappingURL=login.css.map*/
    </style>
@endpush

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
                        terms_and_conditions: ('{{ old('terms_and_conditions') }}' ==  null) ? false : '{{ old('terms_and_conditions') }}',
                        visible: false,
                    }
                };
            },
        });
    </script>
@endpush

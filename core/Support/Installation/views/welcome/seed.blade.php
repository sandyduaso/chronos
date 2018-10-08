@extends("Install::layouts.installation")

@section("head-title", $application->pluma->title)
@section("head-subtitle", "| " . $application->pluma->tagline)

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid>
        <v-layout row wrap>
            <v-flex sm8 md6 offset-sm2 offset-md3>
                <v-card class="mt-4 mb-3 elevation-1 grey--text">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="headline primary--text">{!! $application->site->title !!} | {{ $application->site->tagline }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <h3 class="headline grey--text">{{ __('Seeding') }}</h3>
                        <p class="subheading">{!! __('Done migrating tables. Successfully finished setting up the database.') !!}</p>
                        <p>{!! __("Below, specify your site's <code>Superadmin Account</code>. It will then also seed your database with other default settings.") !!}</p>
                    </v-card-text>

                    <form action="{{ route('installation.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            <legend><strong>{{ __('Superadmin') }}</strong></legend>
                            <p class="grey--text">{{ __("The account you will be creating below will be the main account used to login to the application.") }}</p>
                            <v-text-field
                                :error-messages="resource.errors.email"
                                label="{{ __('Email') }}"
                                name="email"
                                input-group
                                type="email"
                                value="{{ old('email') ? old('email') : env('MAIL_USERNAME') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.password"
                                label="{{ __('Password') }}"
                                name="password"
                                input-group
                                type="password"
                                value="{{ old('password') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.password_confirmation"
                                label="{{ __('Password Confirmation') }}"
                                name="password_confirmation"
                                input-group
                                type="password"
                                value="{{ old('password_confirmation') }}"
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <small class="grey--text"><em>{{ __('Clicking the button will also seed the database of other data. This might take a while.') }}</em></small>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Seed') }}</v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: [],
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },
        });
    </script>
@endpush

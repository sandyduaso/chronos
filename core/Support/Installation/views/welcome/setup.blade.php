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
                        <v-toolbar-title class="headline primary--text">{!! __('Installation Setup') !!}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <p class="subheading">{!! __('You are about to install <strong>Pluma&trade;</strong> and all its components.') !!}</p>
                        <p>{!! __('Below, you may specify the configurations crucial in installing the app. Alternatively, you may specify these configurations in a <code>.env</code> file located at the root of the project.') !!}</p>
                    </v-card-text>

                    <form action="{{ route('installation.setup') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            <p>{!! __("This is your <code>.env</code> file. If you wan't to edit it here, make sure to set the folder to <code>0777</code> temporarily.") !!}</p>
                            <legend><strong>{{ __('Application') }}</strong></legend>
                            <v-text-field
                                :error-messages="resource.errors.APP_NAME"
                                label="{{ __('Name') }}"
                                name="APP_NAME"
                                input-group
                                value="{{ old('APP_NAME') ? old('APP_NAME') : env('APP_NAME') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.APP_TAGLINE"
                                label="{{ __('Tagline') }}"
                                name="APP_TAGLINE"
                                input-group
                                value="{{ old('APP_TAGLINE') ? old('APP_TAGLINE') : env('APP_TAGLINE') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.APP_YEAR"
                                label="{{ __('Year') }}"
                                name="APP_YEAR"
                                hint="{{ __('The year your application started since') }}"
                                persistent-hint
                                input-group
                                value="{{ old('APP_YEAR') ? old('APP_YEAR') : date('Y') }}"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-text>
                            <legend><strong>{{ __("Database") }}</strong></legend>
                            <p>{{ __('Make sure you have correctly specified your database, database username, and database password below. If no existing database is found, the installer will try and create it for you (make sure the user have the appropriate permissions).') }}</p>
                            <v-text-field
                                :error-messages="resource.errors.DB_CONNECTION"
                                label="{{ __('Connection') }}"
                                name="DB_CONNECTION"
                                input-group
                                value="{{ old('DB_CONNECTION') ? old('DB_CONNECTION') : env('DB_CONNECTION') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.DB_HOST"
                                label="{{ __('Host') }}"
                                name="DB_HOST"
                                input-group
                                hint="{{ __('Usually localhost') }}"
                                persistent-hint
                                value="{{ old('DB_HOST') ? old('DB_HOST') : env('DB_HOST') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.DB_PORT"
                                label="{{ __('Port') }}"
                                name="DB_PORT"
                                input-group
                                value="{{ old('DB_PORT') ? old('DB_PORT') : env('DB_PORT') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.DB_DATABASE"
                                label="{{ __('Database') }}"
                                name="DB_DATABASE"
                                input-group
                                value="{{ old('DB_DATABASE') ? old('DB_DATABASE') : env('DB_DATABASE') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.DB_USERNAME"
                                label="{{ __('Username') }}"
                                name="DB_USERNAME"
                                input-group
                                value="{{ old('DB_USERNAME') ? old('DB_USERNAME') : env('DB_USERNAME') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.DB_PASSWORD"
                                label="{{ __('Password') }}"
                                name="DB_PASSWORD"
                                type="password"
                                input-group
                                value="{{ old('DB_PASSWORD') ? old('DB_PASSWORD') : env('DB_PASSWORD') }}"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-text>
                            <legend><strong>{{ __('Mail') }}</strong></legend>
                            <p>{{ __("Below, you may specify your server's default mail configurations. Leave blank if unsure or want to configure later.") }}</p>
                            <v-text-field
                                :error-messages="resource.errors.MAIL_DRIVER"
                                label="{{ __('Driver') }}"
                                name="MAIL_DRIVER"
                                hint="{{ __('E.g. smtp') }}"
                                persistent-hint
                                input-group
                                value="{{ old('MAIL_DRIVER') ? old('MAIL_DRIVER') : env('MAIL_DRIVER') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.MAIL_HOST"
                                label="{{ __('Host') }}"
                                name="MAIL_HOST"
                                input-group
                                value="{{ old('MAIL_HOST') ? old('MAIL_HOST') : env('MAIL_HOST') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.MAIL_PORT"
                                label="{{ __('Port') }}"
                                name="MAIL_PORT"
                                input-group
                                value="{{ old('MAIL_PORT') ? old('MAIL_PORT') : env('MAIL_PORT') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.MAIL_ENCRYPTION"
                                label="{{ __('Encryption') }}"
                                name="MAIL_ENCRYPTION"
                                hint="{{ __('E.g. ssl, tls') }}"
                                persistent-hint
                                input-group
                                value="{{ old('MAIL_ENCRYPTION') ? old('MAIL_ENCRYPTION') : env('MAIL_ENCRYPTION') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.MAIL_USERNAME"
                                label="{{ __('Username') }}"
                                name="MAIL_USERNAME"
                                input-group
                                value="{{ old('MAIL_USERNAME') ? old('MAIL_USERNAME') : env('MAIL_USERNAME') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.MAIL_PASSWORD"
                                label="{{ __('Password') }}"
                                name="MAIL_PASSWORD"
                                input-group
                                type="password"
                                value="{{ old('MAIL_PASSWORD') ? old('MAIL_PASSWORD') : env('MAIL_PASSWORD') }}"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn primary type="submit">{{ __('Install') }}</v-btn>
                        </v-card-actions>
                    </form>


                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <small class="grey--text mt-2"><a href="{{ assets('frontier/docs/LICENSE.md') }}">{{ __('License') }}</a></small>
                        <small class="grey--text mt-2"><a href="{{ assets('frontier/docs/LICENSE.md') }}">{{ __('Terms and Conditions') }}</a></small>
                        {{-- <small class="grey--text mt-2"><a href="{{ assets('frontier/docs/LICENSE.md') }}">{{ __('Developer') }}</a></small> --}}
                        {{-- <v-spacer></v-spacer> --}}
                    </v-card-actions>

                </v-card>
                <div class="text-xs-center">
                    <small class="grey--text">{!! __("If you think there is a mistake, and you've already installed the app, then check if the .install file is on the storage folder. If it exists, simply delete it.") !!} </small>
                    <small class="grey--text">Please also refer to the <a href="{{ route('installation.documentation') }}">documentation</a> page.</small>
                </div>
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
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },
        });
    </script>
@endpush

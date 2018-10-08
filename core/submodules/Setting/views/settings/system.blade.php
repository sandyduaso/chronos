@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="grey darken-4 elevation-0">
        <v-icon class="white--text">{{ navigations('current')->icon }}</v-icon>
        <v-toolbar-title class="white--text">{{ __('System Information') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="grey darken-3">

        <v-layout row wrap>

            <v-flex sm3 md3>
                @include("Setting::partials.settingsbar")
            </v-flex>

            <v-flex sm9 md9>
                <v-layout row wrap>
                    <v-flex sm9 md3>
                        <v-card class="grey body-1 white--text darken-2 elevation-10">
                            <v-card-text>
                                <div class="body-2">{{ __('Your are logged in as') }}</div>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-avatar>
                                    <img src="{{ user()->avatar }}">
                                </v-avatar>
                                <div>
                                    <div>{{ user()->fullname }}</div>
                                    <div>{{ user()->displayrole }}</div>
                                </div>
                            </v-card-actions>
                        </v-card>
                        <v-card flat class="mb-3 transparent">
                            <v-card-text>
                                <v-subheader class="white--text">{{ __('Application Details') }}</v-subheader>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Pluma CMS Version') }}</div>
                                    <div>{{ PLUMA_VERSION }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Environment') }}</div>
                                    <div>{{ config('APP_ENV', env('APP_ENV')) }}</div>
                                    @if (config('APP_ENV', env('APP_ENV')) === 'development')
                                        <div class="warning--text">
                                            <v-icon left class="warning--text">warning</v-icon>
                                            <span>{{ __("You are in DEVELOPMENT MODE. Recommended 'production'.") }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Author') }}</div>
                                    <div>{{ config('APP_AUTHOR', env('APP_AUTHOR')) }}</div>
                                    @if (! config('APP_AUTHOR', env('APP_AUTHOR')))
                                        <div class="warning--text">
                                            <v-icon left class="warning--text">warning</v-icon>
                                            <span>{{ __("No application author. It would be nice to know who wrote this application.") }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Year') }}</div>
                                    <div>{{ config('APP_YEAR', env('APP_YEAR')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Timezone') }}</div>
                                    <div>{{ date_default_timezone_get() }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Application Key') }}</div>
                                    <v-text-field hide-details readonly dark value="{{ config('encryption.key', env('APP_KEY')) }}"></v-text-field>
                                    @if (! config('encryption.key', env('APP_KEY')))
                                        <div class="error--text">
                                            <v-icon left class="error--text">error</v-icon>
                                            <span>{{ __("No APP_KEY found! Please generate a random key for your application.") }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Debug') }}</div>
                                    <div>{{ config('APP_DEBUG', env('APP_DEBUG')) ? "ON" : "OFF" }}</div>
                                    @if (config('APP_DEBUG', env('APP_DEBUG')))
                                        <div class="warning--text">
                                            <v-icon left class="warning--text">warning</v-icon>
                                            <span>{{ __("Debugging is recommended to be turned OFF if you are deployed to your live server.") }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Modules Installed') }}</div>
                                    <div>{{ count(get_modules_path(false, false)) }}</div>
                                    <div class="info--text">
                                        <a href="#" class="caption">{{ __("Manage Modules") }}</a>
                                    </div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Themes Installed') }}</div>
                                    <div>{{ count(get_themes()) }}</div>
                                    <div>{{ "Current: " . settings('active_theme', 'default') }}</div>
                                    <div class="info--text">
                                        <a href="{{ route('themes.index') }}" class="caption">{{ __("Manage Themes") }}</a>
                                    </div>
                                </div>

                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex xs12 sm4 md3>
                        <v-card flat class="mb-3 transparent">
                            <v-card-text>
                                <v-subheader class="white--text">{{ __('Database Environment') }}</v-subheader>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Connection') }}</div>
                                    <div>{{ config('DB_CONNECTION', env('DB_CONNECTION')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Host') }}</div>
                                    <div>{{ config('DB_HOST', env('DB_HOST')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Port') }}</div>
                                    <div>{{ config('DB_PORT', env('DB_PORT')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Database') }}</div>
                                    <div>{{ config('DB_DATABASE', env('DB_DATABASE')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Username') }}</div>
                                    <div>{{ config('DB_USERNAME', env('DB_USERNAME')) }}</div>
                                    @if (config('DB_USERNAME', env('DB_USERNAME')) == "root")
                                        <div class="warning--text">
                                            <v-icon left class="warning--text">warning</v-icon>
                                            <span>{{ __("It might be safer to have another user managing this app's database other than 'root'.") }}</span>
                                        </div>
                                    @endif
                                </div>

                            </v-card-text>

                            <v-card-text>
                                <v-subheader class="white--text">{{ __('Mail Environment') }}</v-subheader>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Driver') }}</div>
                                    <div>{{ config('MAIL_DRIVER', env('MAIL_DRIVER')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Host') }}</div>
                                    <div>{{ config('MAIL_HOST', env('MAIL_HOST')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Port') }}</div>
                                    <div>{{ config('MAIL_PORT', env('MAIL_PORT')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Encryption') }}</div>
                                    <div>{{ config('MAIL_ENCRYPTION', env('MAIL_ENCRYPTION')) }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Username') }}</div>
                                    <div>{{ config('MAIL_USERNAME', env('MAIL_USERNAME')) }}</div>
                                </div>

                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex xs12 sm4 md3>

                        <v-card dark flat class="mb-3 grey darken-3">
                            <v-card-text>

                                <v-subheader class="white--text">{{ __('Server Environment') }}</v-subheader>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Server Software') }}</div>
                                    <div>{{ $_SERVER['SERVER_SOFTWARE'] }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Server Admin') }}</div>
                                    <div>{{ $_SERVER['SERVER_ADMIN'] }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Document Root') }}</div>
                                    <div>{{ $_SERVER['DOCUMENT_ROOT'] }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Remote Address') }}</div>
                                    <div>{{ $_SERVER['REMOTE_ADDR'] }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Server Signature') }}</div>
                                    <div>{!! $_SERVER['SERVER_SIGNATURE'] !!}</div>
                                </div>

                            </v-card-text>

                            <v-card-text>
                                <v-subheader class="white--text">{{ __('PHP') }}</v-subheader>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('PHP Version') }}</div>
                                    <div>{{ PHP_VERSION }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Maximum Execution Timeout') }}</div>
                                    <div>{{ "max_execution_time: " . ini_get('max_execution_time') }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Maximum File Uploads') }}</div>
                                    <div>{{ "max_file_uploads: " . ini_get('max_file_uploads') }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Post Maximum Size') }}</div>
                                    <div>{{ "post_max_size: " . ini_get('post_max_size') }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Upload Max Filesize') }}</div>
                                    <div>{{ "upload_max_filesize: " . ini_get('upload_max_filesize') }}</div>
                                </div>

                            </v-card-text>

                        </v-card>

                    </v-flex>

                    <v-flex xs12 sm4 md3>
                        <v-card flat class="mb-3 transparent">
                            <v-card-text>

                                <v-subheader class="white--text">{{ __('System Environment') }}</v-subheader>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Host Name') }}</div>
                                    <div>{{ gethostname() }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('OS') }}</div>
                                    <div>{{ PHP_OS . " " . php_uname('m') }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('Release Name') }}</div>
                                    <div>{{ php_uname('r') }}</div>
                                </div>

                                <div class="white--text body-1 pa-3">
                                    <div class="grey--text body-2">{{ __('HTTP User Agent') }}</div>
                                    <div>{{ $_SERVER['HTTP_USER_AGENT'] }}</div>
                                </div>

                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>

        </v-layout>
    </v-container>
@endsection

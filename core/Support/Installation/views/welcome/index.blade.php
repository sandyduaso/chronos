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
                        <v-toolbar-title class="display-1 grey--text text--darken-2">{!! __('Pluma CMS&trade; | Welcome') !!}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <p class="subheading">{!! __('Thank you for using <strong>Pluma&trade;</strong> CMS. This page will guide you through the installation process.') !!}</p>
                    </v-card-text>

                    <v-card-text>
                        <h3 class="headline primary--text">{{ __('Before We Begin') }}</h3>
                        <p>{!! __('The application needs some information on the database from you. You will need to know the following items before proceeding:') !!}</p>

                        <ul class="ma-4">
                            <li>Database name</li>
                            <li>Host name (usually localhost)</li>
                            <li>User</li>
                            <li>Password</li>
                        </ul>

                        <p>{!! __('These must be pre-configured on your <code>.env</code> file. If the database does not exist, the application will try to create one, based on the name given in the <code>.env</code> file. Note that the <em>database user</em> must have the appropriate permissions.') !!}</p>

                        <p>{!! __("If you don't have the information above, you may have to contact your Web Host to supply them for you.") !!}</p>

                        <p>{{ __("Now then. If you're ready, then we're ready. Tap the start button.") }}</p>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn primary href="{{ route('installation.setup.form') }}">{{ __('Start') }}</v-btn>
                    </v-card-actions>

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

@extends("Install::layouts.installation")

@section("head-title", $application->pluma->title)
@section("head-subtitle", "| " . $application->pluma->tagline)

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid>
        <v-layout row wrap>
            <v-flex sm8 md6 offset-sm2 offset-md3>
                <v-card class="mt-4 mb-3 transparent elevation-0 grey--text">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="display-2 error--text">{!! __('Oh noes! :(') !!}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <p class="headline">{{ __("Something went wrong. But nothing too terrible, since we are able to catch it. So there's that.") }}</p>
                        <p class="subheadline">{{ __("Below is what we've gathered thus far:") }}</p>

                        <blockquote class="error mb-4"><span class="white--text">Error: {{ $e->getMessage() }}</span></blockquote>

                        <p>{{ __("Here are some helpful things to do:") }}</p>
                        <ul class="mb-4">
                            <li>
                                <span class="grey--text">
                                    <strong><code>.env</code> Permission Denied</strong>.
                                    It means the application cannot write to the folder your .env is located. Recommended to write it manually, then rerun the setup.
                                    Though not recommended, you can try and make the entire pluma folder writable temporarily: <br>
                                    <code>$ sudo chmod -R 777 /path/to/pluma</code><br>
                                    Make sure after the install, you revert it back:
                                    <code>$ chmod -R 755 /path/to/pluma</code><br>
                                    <code>$ chmod -R 777 /path/to/pluma/storage</code>
                                </span>
                            </li>
                            <li>
                                <span class="grey--text">
                                    <strong>{{ __('General Write Permissions') }}</strong>. Make sure you have the right permissions to write in the <code>/storage</code> folder.
                                    From your terminal, try: <br>
                                    <code>$ chmod -R 755 /path/to/pluma</code><br>
                                    <code>$ chmod -R 777 /path/to/pluma/storage</code>
                                </span>
                            </li>
                            <li>
                                <span class="grey--text">
                                    <strong>{{ __('Missing Dependencies') }}</strong>.
                                    {{ __('Pluma relies on composer packages. If the error above resembles something about an issue in autoloading, you should run') }}
                                    <code>$ composer install && composer dump-autoload -o</code>
                                </span>
                            </li>
                            <li>
                                <span class="grey--text">
                                    <strong>{{ __('Corrupt Files') }}</strong>. Try downloading the <code>pluma</code> project again, and rerun the installation.
                                </span>
                            </li>
                        </ul>

                        <p class="subheadline">{{ __('If none could work, try looking at the error logs, or contacting your Host Provider.') }}</p>

                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

@endsection

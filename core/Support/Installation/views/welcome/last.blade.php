@extends("Install::layouts.installation")

@section("head-title", $application->site->title)
@section("head-subtitle", "| " . $application->site->tagline)

@section("content")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex sm8 md6 offset-sm2 offset-md3>

                @include("Theme::partials.banner")

                <v-card class="mt-4 mb-3 elevation-1 grey--text">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="headline primary--text">{!! $application->site->title !!} | {{ __('Finished Installation') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <p class="subheading">{{ __('Done! you may still edit additional configurations in settings.') }}</p>

                        <p>{{ __('Here are your credentials:') }}</p>
                        <ul class="mb-2">
                            <li>
                                <v-text-field
                                    disabled
                                    hide-details
                                    input-group
                                    label="{{ __('Username') }}"
                                    disabled
                                    value="{{ $user->username }}"
                                ></v-text-field>
                            </li>
                            <li>
                                <v-text-field
                                    disabled
                                    hide-details
                                    input-group
                                    label="{{ __('Password') }}"
                                    disabled
                                    value="{{ 'Your chosen password' }}"
                                ></v-text-field>
                            </li>
                        </ul>

                        @if (file_exists(storage_path('.installed')))
                            <v-btn primary href="{{ url(config('paths.admin', 'admin')) }}">{{ __('Login') }}</v-btn>
                        @else
                            <p>{{ __('Click the button below to delete the remaining installation files. This is required to continue.') }}</p>

                            <form action="{{ route('installation.clean') }}" method="POST">
                                {{ csrf_field() }}
                                <v-btn primary type="submit" class="mb-3">{{ _('Clean Installation Files') }}</v-btn>
                            </form>

                            <p>{{ __("Alternatively, you may manually delete the files listed below if the button doesn't work (this is usually due to file permission issues).") }}</p>

                            <ul class="mt-1 mb-2">
                                <li>/path/to/pluma/storage/.migrated</li>
                                <li>/path/to/pluma/storage/.install</li>
                            </ul>
                        @endif

                    </v-card-text>
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
                    settings: {},
                    resource: {
                        item: [],
                        model: false,
                        remember: true,
                        visible: false,
                    }
                };
            },
        });
    </script>
@endpush

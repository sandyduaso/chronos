@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="sticky secondary elevation-1">
        <v-icon left dark>comment</v-icon>
        <v-toolbar-title>{{ __('Commenting') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="white">

        @include("Theme::partials.banner")

        <v-layout row wrap>

            <v-flex md4 sm6>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm8 md6>


                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card flat class="mb-3">
                        <v-card-text>
                            <v-checkbox
                                label="{{ __('Enable comment section for modules') }}"
                                hint="{{ __('Only applicable for Modules that support commenting. Give roles an ability to comment through <a target="_blank" href="'.route('roles.index').'">Roles and Permissions</a>. ') }}"
                                persistent-hint
                                v-model="resource.item.is_commenting_enabled"
                            ></v-checkbox>
                            <input type="hidden" name="is_commenting_enabled" :value="resource.item.is_commenting_enabled">

                        </v-card-text>
                        <v-subheader class="page-title">{{ __('Global Blacklisted Words') }}</v-subheader>
                        <v-card-text class="body-1">
                            <p class="grey--text">{{ __('Words listed bellow will be banned from all available comments section.') }}</p>
                            <p class="grey--text">{{ __("You may also specify blacklisted words for a certain module from the module's own settings page.") }}</p>
                            <v-text-field multi-line name="banned_words" v-model="resource.item.banned_words"></v-text-field>
                            <v-checkbox
                                label="{{ __('Check for exact word match only') }}"
                                hint="{{ __('Note that if uncheck, the process may produce unintentional filtering, e.g ***ignment if the word `ass` is blacklisted.') }}"
                                persistent-hint
                                v-model="resource.item.is_check_exact_banned_words"
                            ></v-checkbox>
                            <input type="hidden" name="is_check_exact_banned_words" :value="resource.item.is_check_exact_banned_words">
                        </v-card-text>

                        <v-card-actions>
                            <v-btn type="submit" primary class="elevation-1">{{ __('Save') }}</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </form>

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
                        item: {
                            is_commenting_enabled: {{ old('is_commenting_enabled', settings('is_commenting_enabled', 'true')) }},
                            banned_words: {!! json_encode(old('banned_words') ?? settings('banned_words', 'fuck')) !!},
                            is_check_exact_banned_words: {{ old('is_check_exact_banned_words', settings('is_check_exact_banned_words', 'true')) }},
                        },
                    },
                };
            },
        });
    </script>
@endpush

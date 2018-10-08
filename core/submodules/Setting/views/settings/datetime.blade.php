@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="sticky secondary elevation-1">
        <v-icon left dark>access_time</v-icon>
        <v-toolbar-title>{!! __('Date &amp; Time') !!}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="white">

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex md4 sm6>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm6 md4>


                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card flat class="mb-3">
                        <v-subheader>{{ __('Formatting') }}</v-subheader>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Date Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="date_format" :value="resource.radios.date_format.model">
                                    <v-radio-group hide-details class="mb-0" v-model="resource.radios.date_format.model" :mandatory="true">
                                        <v-radio hide-details input-value="F d, Y" value="F d, Y" label="F d, Y ({{ date('F d, Y') }})"></v-radio>
                                        <v-radio hide-details input-value="Y-m-d" value="Y-m-d" label="Y-m-d ({{ date('Y-m-d') }})"></v-radio>
                                        <v-radio hide-details input-value="Y/m/d" value="Y/m/d" label="Y/m/d ({{ date('Y/m/d') }})"></v-radio>
                                        <v-radio hide-details label="{{ __('Custom Format') }}" hide-details :input-value="resource.radios.date_format.custom" :value="resource.radios.date_format.custom"></v-radio>
                                    </v-radio-group>
                                    <v-text-field
                                        label="{{ __('Custom Date Format') }}"
                                        v-model="resource.radios.date_format.custom"
                                        input-group
                                        hide-details
                                        @input="(val) => { resource.radios.date_format.model = val }"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Time Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="time_format" :value="resource.radios.time_format.model">
                                    <v-radio-group hide-details class="mb-0" v-model="resource.radios.time_format.model" :mandatory="true">
                                        <v-radio hide-details input-value="h:i A" value="h:i A" label="h:i A (01:00 PM)"></v-radio>
                                        <v-radio hide-details input-value="H:i:s" value="H:i:s" label="H:i:s (13:00:00)"></v-radio>
                                        <v-radio hide-details label="{{ __('Custom Format') }}" :input-value="resource.radios.time_format.custom" :value="resource.radios.time_format.custom"></v-radio>
                                    </v-radio-group>
                                    <v-text-field
                                        label="{{ __('Custom Time Format') }}"
                                        v-model="resource.radios.time_format.custom"
                                        input-group
                                        hide-details
                                        @input="(val) => { resource.radios.time_format.model = val }"
                                    ></v-text-field>
                                    <div class="caption grey--text">
                                        {{ __('Format follows constants from') }} <a target="_blank" href="http://php.net/manual/en/function.date.php">{{ __('PHP Date Format Manual') }}</a>
                                    </div>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
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
                            items_per_page: '{{ old('items_per_page') ?? settings('items_per_page', 15) }}',
                            excerpt_length: '{{ old('excerpt_length') ?? settings('excerpt_length', 30) }}',
                        },
                        radios: {
                            membership: {
                                items: {!! json_encode(config('auth.registration.modes', [])) !!},
                                model: '{{ @$resource->site_membership ? $resource->site_membership : config('auth.registration.default', 2) }}',
                            },
                            date_format: {
                                custom: 'm/d/Y',
                                model: '{{ @$resource->date_format ? $resource->date_format : config('settings.date_format', 'F d, Y') }}'
                            },
                            time_format: {
                                custom: 'H:i:s a',
                                model: '{{ old('time_format') ?? settings('time_format') }}'
                            }
                        },
                    },
                };
            },
        });
    </script>
@endpush

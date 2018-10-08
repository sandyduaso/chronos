@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="sticky secondary elevation-1">
        <v-icon left dark>fa-table</v-icon>
        <v-toolbar-title>{{ __('Displaying Data') }}</v-toolbar-title>
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
                        {{-- <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Displaying Data') }}</v-toolbar-title>
                        </v-toolbar> --}}
                        <v-subheader>{{ __('Global Display Data') }}</v-subheader>
                        <v-card-text>
                            <v-select label="{{ __('Items per Page') }}" hint="{{ __('Default: 15 items') }}" persistent-hint item-value="value" v-model="resource.item.items_per_page" :items="[{'value':5,text:'5'}, {'value':10,text:'10'}, {'value':15,text:'15'}, {'value':20,text:'20'}, {'value':30,text:'30'}, {'value':50,text:'50'}, {'value':100,text:'100'}]"></v-select>
                            <input type="hidden" name="items_per_page" :value="resource.item.items_per_page">

                            <v-text-field
                                type="number"
                                label="{{ __('Excerpt Length') }}"
                                v-model="resource.item.excerpt_length"
                                suffix="{{ __('words') }}"
                                name="excerpt_length"
                                hint="{{ __('Default: 30 words') }}"
                                persistent-hint
                                input-group
                                @input="(val) => { resource.item.excerpt_length = val }"
                            ></v-text-field>
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
                            items_per_page: {{ old('items_per_page', settings('items_per_page', 15)) }},
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

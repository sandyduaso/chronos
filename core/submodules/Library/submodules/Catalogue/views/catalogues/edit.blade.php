@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8 offset-sm2>

                @include("Theme::partials.banner")

                <v-card class="grey--text elevation-1 mb-2">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Edit Catalogue') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn flat href="{{ route('catalogues.index') }}"><v-icon>keyboard_backspace</v-icon>{{ _('Back') }}</v-btn>
                    </v-toolbar>
                    <form action="{{ route('catalogues.update', $resource->id) }}" method="POST">
                        <v-card-text>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="Name"
                                name="name"
                                value="{{ $resource->name }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.code"
                                hint="{{ __('Will be used as an ID for Catalogues. Make sure the code is unique.') }}"
                                label="Code"
                                name="code"
                                :value="resource.item.name ? resource.item.name : '{{ $resource->code }}' | slugify"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.description"
                                label="Description"
                                name="description"
                                value="{{ $resource->description }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.alias"
                                hint="{{ __('Will be used as an alias.') }}"
                                label="{{ _('Alias') }}"
                                value="{{ $resource->alias }}"
                                name="alias"
                            ></v-text-field>

                            <v-menu
                                :position-absolutely="true"
                                offset-x
                                offset-y
                                style="width: 100%"
                                v-model="resource.icons.model"
                            >
                                <v-text-field
                                    slot="activator"
                                    :append-icon-cb="() => { resource.icons.model = !resource.icons.model }"
                                    :error-messages="resource.errors.icon"
                                    :prepend-icon="resource.icons.value"
                                    :value="resource.icons.value"
                                    append-icon="fa-ellipsis-h"
                                    hint="{{ __('Browse through suggested icons by clicking the button above') }}"
                                    label="{{ _('Icon') }}"
                                    name="icon"
                                    @input="val => { resource.icons.value = val }"

                                ></v-text-field>
                                <v-card>
                                    <v-list>
                                        <v-list-tile v-for="item in resource.icons.items" :key="item.name" @click="resource.icons.value = item.name">
                                            <v-list-tile-action>
                                                <v-icon>@{{ item.name }}</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-title>@{{ item.name }}</v-list-tile-title>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </v-menu>

                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn primary type="submit" class="elevation-1">{{ _('Update') }}</v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            grants: '',
                        },
                        icons: {
                            model: false,
                            items: [],
                            value: '{{ $resource->icon }}',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    suppliments: {
                        grants: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            ],
                            pagination: {
                                rowsPerPage: '{{ settings('items_per_page', 15) }}',
                                totalItems: 0,
                            },
                            items: [],
                            selected: [],
                            searchform: {
                                query: '',
                                model: true,
                            }
                        }
                    },
                };
            },

            methods: {
                mountSuppliments () {
                    this.resource.icons.items = [
                        { name: 'account_balance' },
                        { name: 'account_box' },
                        { name: 'attach_file' },
                        { name: 'book' },
                        { name: 'bookmark_border' },
                        { name: 'cloud' },
                        { name: 'collections' },
                        { name: 'fa-calendar-o' },
                        { name: 'fa-clock-o' },
                        { name: 'folder_open' },
                        { name: 'insert_drive_file' },
                        { name: 'verified_user' },
                    ];
                },
            },

            mounted () {
                this.mountSuppliments();
            }
        });
    </script>
@endpush

@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm4 offset-sm4>
                @include("Theme::partials.banner")

                <form action="{{ route('pages.categories.update', $resource->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <v-card class="elevation-1">
                        <v-toolbar flat class="transparent">
                            <v-icon>label</v-icon>
                            <v-toolbar-title class="subheading">{{ __("Edit Page Category") }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="{{ __('Name') }}"
                                name="name"
                                v-model="resource.item.name"
                                @input="resource.item.code = $options.filters.slugify(resource.item.name)"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                label="{{ __('Code') }}"
                                name="code"
                                v-model="resource.item.code"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.alias"
                                label="{{ __('Alias') }}"
                                name="alias"
                                v-model="resource.item.alias"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.description"
                                label="{{ __('Description') }}"
                                name="description"
                                v-model="resource.item.description"
                            ></v-text-field>

                            <v-menu full-width offset-y offset-x>
                                <v-text-field
                                    :append-icon="resource.item.icon ? resource.item.icon : 'more_horiz'"
                                    :error-messages="resource.errors.icon"
                                    hint="{{ __('Click to show list of default icons') }}"
                                    label="{{ __('Icon') }}"
                                    name="icon"
                                    persistent-hint
                                    slot="activator"
                                    v-model="resource.item.icon"
                                ></v-text-field>
                                <v-card>
                                    <v-list>
                                        <v-list-tile ripple @click="resource.item.icon = icon" :key="i" v-for="(icon, i) in misc.icons">
                                            <v-list-tile-avatar>
                                                <v-icon v-html="icon"></v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <span v-html="icon"></span>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </v-menu>
                            <input type="hidden" name="type" value="{{ $type }}">
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn flat href="{{ route('pages.categories.index') }}">{{ __('Cancel') }}</v-btn>
                            <v-btn type="submit" primary>{{ __('Update') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '{{ $resource->name }}',
                            alias: '{{ $resource->alias }}',
                            code: '{{ $resource->code }}',
                            description: '{{ $resource->description }}',
                            icon: '{{ $resource->icon }}',
                            type: '{{ $resource->type }}',
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },

                    bulk: {
                        commands: {
                            model: false,
                        },
                    },

                    urls: {
                        categories: {
                            edit: '{{ route('pages.categories.edit', 'null') }}',
                            destroy: '{{ route('pages.categories.destroy', 'null') }}',
                        }
                    },

                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Icon") }}', align: 'left', value: 'icon' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Alias") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Modified") }}', align: 'left', value: 'modified_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: '{{ settings('items_per_page', 15) }}',
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },

                    misc: {
                        icons: [
                            'bookmark',
                            'landscape',
                            'fa-bullhorn',
                            'build',
                            'code',
                            'description',
                            'warning',
                            'album',
                            'video_library',
                        ],
                    }
                };
            },
        })
    </script>
@endpush

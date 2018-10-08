@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3>
                <form action="{{ route('categories.store', 'pages') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1">
                        <v-toolbar flat class="transparent">
                            <v-icon>label</v-icon>
                            <v-toolbar-title class="subheading">{{ __("New Category") }}</v-toolbar-title>
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
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
            <v-flex sm9>

                <v-card class="mb-3 elevation-1">
                    <v-toolbar flat class="transparent">
                        <v-toolbar-title class="subheading">{{ __('All Categories') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.commands.model"
                            :class="bulk.commands.model ? 'btn--active error error--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
                            @click.native="bulk.commands.model = !bulk.commands.model"
                        ><v-icon>@{{ bulk.commands.model ? 'indeterminate_check_box' : 'check_box_outline_blank' }}</v-icon></v-btn>

                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form :action="route(urls.categories.destroy, false)" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="id[]" :value="item.id">
                                    </template>
                                    <v-dialog full-width ref="permabox">
                                        <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}"><v-icon error>delete_sweep</v-icon></v-btn>
                                        <v-card>
                                            <v-card-text>
                                                {{ __('You are about to permanently delete items. Are you sure you want to proceed?') }}
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn flat error type="submit">{{ __('Yes') }}</v-btn>
                                                <v-btn flat @click="$refs.permabox.hide()">{{ __('Cancel') }}</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- /Bulk Delete --}}
                        {{-- /Batch Commands --}}

                        {{-- Search --}}
                        <v-text-field
                            append-icon="search"
                            label="{{ _('Search') }}"
                            single-line
                            hide-details
                            v-if="dataset.searchform.model"
                            v-model="dataset.searchform.query"
                            light
                        ></v-text-field>
                        <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat light @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                            <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                        </v-btn>
                        {{-- /Search --}}
                    </v-toolbar>
                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        v-bind="bulk.commands.model?{'select-all':'primary'}:[]"
                        {{-- selected-key="id" --}}
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected">
                        <template slot="headerCell" scope="props">
                            <span v-tooltip:bottom="{'html': props.header.text}">
                                @{{ props.header.text }}
                            </span>
                        </template>
                        <template slot="items" scope="prop">
                            <td v-show="bulk.commands.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td v-html="prop.item.id"></td>
                            <td><v-icon v-html="prop.item.icon"></v-icon></td>
                            <td><a :href="route(urls.categories.edit, (prop.item.id))"><strong v-html="prop.item.name"></strong></a></td>
                            <td v-html="prop.item.code"></td>
                            <td v-html="prop.item.alias"></td>
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile :href="route(urls.categories.edit, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="$refs.destroy.submit()">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form ref="destroy" :action="route(urls.categories.destroy, prop.item.id)" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        {{ __('Move to Trash') }}
                                                        {{-- <v-btn type="submit">{{ __('Move to Trash') }}</v-btn> --}}
                                                    </form>
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </td>
                        </template>
                    </v-data-table>
                </v-card>

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
                            name: '{{ old('name') }}',
                            alias: '{{ old('alias') }}',
                            code: '{{ old('code') }}',
                            description: '{{ old('description') }}',
                            icon: '{{ old('icon') }}',
                            type: '{{ old('type') }}',
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
                            edit: '{{ route('categories.edit', 'null') }}',
                            destroy: '{{ route('categories.destroy', 'null') }}',
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

            watch: {
                'dataset.pagination': {
                    handler () {
                        this.get();
                    },
                    deep: true
                },

                'dataset.searchform.query': function (filter) {
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            search: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.categories.search', 'pages') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },

            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.categories.all', 'pages') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.get();
            }
        })
    </script>
@endpush

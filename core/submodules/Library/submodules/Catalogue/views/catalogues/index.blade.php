@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>

            <v-flex sm5 md4 xs12>
                <v-card class="elevation-1 mb-3">
                    <v-toolbar card class="transparent">
                        <v-icon class="accent--text">book</v-icon>
                        <v-toolbar-title class="accent--text">{{ __('New Catalogue') }}</v-toolbar-title>
                    </v-toolbar>

                    <form action="{{ route('catalogues.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="{{ _('Name') }}"
                                name="name"
                                value="{{ old('name') }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.code"
                                :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                                hint="{{ __('Will be used as a unique catalogue name.') }}"
                                label="{{ _('Code') }}"
                                name="code"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.description"
                                label="{{ _('Short Description') }}"
                                name="description"
                                value="{{ old('description') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.alias"
                                :value="resource.item.name ? resource.item.name : '{{ old('alias') }}'"
                                hint="{{ __('Will be used as an alias.') }}"
                                label="{{ _('Alias') }}"
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
                                    :prepend-icon="'{{ old('icon') }}' ? '{{ old('icon') }}' : resource.icons.value"
                                    :value="'{{ old('icon') }}' ? '{{ old('icon') }}' : resource.icons.value"
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
                            <v-btn type="submit" primary class="elevation-1">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </form>

                </v-card>
            </v-flex>

            <v-flex sm7 md8 xs12>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Catalogues') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.destroy.model"
                            :class="bulk.destroy.model ? 'btn--active error error--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
                            @click.native="bulk.destroy.model = !bulk.destroy.model"
                        ><v-icon>@{{ bulk.destroy.model ? 'indeterminate_check_box' : 'check_box_outline_blank' }}</v-icon></v-btn>
                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form action="{{ route('catalogues.many.destroy') }}" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="catalogues[]" :value="item.id">
                                    </template>
                                    <v-btn
                                        flat
                                        icon
                                        type="submit"
                                        v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"
                                    ><v-icon error>delete_sweep</v-icon></v-btn>
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

                        {{-- Trashed --}}
                        <v-btn
                            icon
                            flat
                            href="{{ route('catalogues.trash') }}"
                            light
                            v-tooltip:left="{'html': `View trashed items`}"
                        ><v-icon>archive</v-icon></v-btn>
                        {{-- /Trashed --}}
                    </v-toolbar>

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        v-bind="bulk.destroy.model?{'select-all':'primary'}:[]"
                        {{-- selected-key="id" --}}
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected"
                    >
                        <template slot="headerCell" scope="props">
                            <span v-tooltip:bottom="{'html': props.header.text}">
                                @{{ props.header.text }}
                            </span>
                        </template>
                        <template slot="items" scope="prop">
                            <td v-show="bulk.destroy.model">
                                <v-checkbox
                                    hide-details
                                    class="pa-0 primary--text"
                                    v-model="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td>@{{ prop.item.id }}</td>
                            <td><v-icon v-html="prop.item.icon"></v-icon></td>
                            <td width="100%">
                                <a :href="route(urls.catalogues.edit, prop.item.id)" class="td-n">
                                    <strong v-tooltip:bottom="{'html': prop.item.description ? prop.item.description : prop.item.name}">@{{ prop.item.name }}</strong>
                                </a>
                            </td>
                            <td>@{{ prop.item.alias }}</td>
                            <td>@{{ prop.item.code }}</td>
                            <td>@{{ prop.item.created }}</td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile :href="route(urls.catalogues.show, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon info>search</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('View details') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile :href="route(urls.catalogues.edit, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile @click="post(route(urls.catalogues.api.clone, (prop.item.id)))">
                                            <v-list-tile-action>
                                                <v-icon accent>content_copy</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Clone') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile
                                            @click="destroy(route(urls.catalogues.api.destroy, prop.item.id),
                                            {
                                                '_token': '{{ csrf_token() }}'
                                            })">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Move to Trash') }}
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
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        destroy: {
                            model: false,
                        },
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Icon") }}', align: 'left', value: 'icon' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Alias") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
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
                            value: '',
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
                    urls: {
                        catalogues: {
                            api: {
                                clone: '{{ route('api.catalogues.clone', 'null') }}',
                                destroy: '{{ route('api.catalogues.destroy', 'null') }}',
                            },
                            show: '{{ route('catalogues.show', 'null') }}',
                            edit: '{{ route('catalogues.edit', 'null') }}',
                            destroy: '{{ route('catalogues.destroy', 'null') }}',
                        },
                    },

                    snackbar: {
                        model: false,
                        text: '',
                        context: '',
                        timeout: 2000,
                        y: 'bottom',
                        x: 'right'
                    },
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
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.catalogues.search') }}', query)
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
                    this.api().get('{{ route('api.catalogues.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                post (url, query) {
                    var self = this;
                    this.api().post(url, query)
                        .then((data) => {
                            self.get('{{ route('api.catalogues.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.catalogues.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

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
                }
            },

            mounted () {
                this.get();
                this.mountSuppliments();
            },
        });
    </script>
@endpush

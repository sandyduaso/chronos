@extends("Theme::layouts.admin")

@section("head-title", __('Trashed Roles'))

@push("utilitybar")
    {{--  --}}
@endpush

@section("content")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>

            <v-flex xs12>

                @include("Theme::partials.banner")

                <v-card class="mb-3">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Trashed Roles') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <div>
                                    {{-- Bulk Restore --}}
                                    <form action="{{ route('roles.many.restore') }}" method="POST" class="inline">
                                        {{ csrf_field() }}
                                        <template v-for="item in dataset.selected">
                                            <input type="hidden" name="roles[]" :value="item.id">
                                        </template>
                                        <button type="submit" v-tooltip:left="{'html': `Restore ${dataset.selected.length} selected items`}" class="btn btn--flat btn--icon"><span class="btn__content"><v-icon>restore</v-icon></span></button>
                                    </form>
                                    {{-- /Bulk Restore --}}

                                    {{-- Bulk Delete --}}
                                    <v-dialog v-model="dataset.dialog.model" lazy width="auto">
                                        <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}"><v-icon>delete_forever</v-icon></v-btn>
                                        <v-card class="text-xs-center">
                                            <v-card-title class="headline">{{ __('Permanent Delete') }}</v-card-title>
                                            <v-card-text >
                                                {{ __("You are about to permanently delete the resources. This action is irreversible. Do you want to proceed?") }}
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn class="green--text darken-1" flat @click.native.stop="dataset.dialog.model=false">{{ __('Cancel') }}</v-btn>
                                                <form action="{{ route('roles.many.delete') }}" method="POST" class="inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <template v-for="item in dataset.selected">
                                                        <input type="hidden" name="roles[]" :value="item.id">
                                                    </template>
                                                    <button type="submit" class="btn btn--flat error--text"><span class="btn__content">{{ __('Delete All Selected Forever') }}</span></button>
                                                </form>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                    {{-- /Bulk Delete --}}
                                </div>
                            </template>
                        </v-slide-y-transition>
                        {{-- /Batch Commands --}}

                    </v-toolbar>

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        select-all
                        selected-key="id"
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
                            <td>
                                <v-checkbox
                                    primary
                                    hide-details
                                    class="pa-0"
                                    v-model="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td>@{{ prop.item.id }}</td>
                            <td><strong v-tooltip:bottom="{'html': prop.item.description ? prop.item.description : prop.item.name}">@{{ prop.item.name }}</strong></td>
                            <td>@{{ prop.item.code }}</td>
                            <td>@{{ prop.item.excerpt }}</td>
                            <td class="text-xs-right">
                                <span v-tooltip:bottom="{'html': '{{ __('Number of grants associated') }}'}">@{{ prop.item.grants ? prop.item.grants.length : 0 }}</span>
                                @{{ prop.item.dialog }}
                            </td>
                            <td>@{{ prop.item.created }}</td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile @click.native.stop="post(route(urls.roles.api.restore, (prop.item.id)))">
                                            <v-list-tile-action>
                                                <v-icon accent>restore</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Restore') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile
                                            @click.native="setDialog(true, prop.item)"
                                        >
                                            <v-list-tile-action>
                                                <v-icon>delete_forever</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Permanently Delete') }}
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

    <v-dialog v-model="resource.dialog.model" persistent lazy width="auto" min-width="200px">
        <v-card class="text-xs-center">
            <v-card-title class="headline">{{ __('Permanently Delete') }} "@{{ resource.dialog.data.name }}"</v-card-title>
            <v-card-text >
                {{ __("You are about to permanently delete the resource. This action is irreversible. Do you want to proceed?") }}
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="green--text darken-1" flat @click.native="resource.dialog.model=false">{{ __('Cancel') }}</v-btn>
                <form :action="route(urls.roles.delete, (resource.dialog.data.id))" method="POST" class="inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <v-btn type="submit" flat class="error error--text">{{ __('Delete Forever') }}</v-btn>
                </form>
            </v-card-actions>
        </v-card>
    </v-dialog>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        dialog: {
                            model: false,
                        },
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            totalItems: 0,
                            trashedOnly: true,
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
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        dialog: {
                            model: false,
                            data: {},
                        }
                    },
                    suppliments: {
                        grants: {
                            items: [],
                            selected: [],
                        }
                    },
                    urls: {
                        roles: {
                            api: {
                                restore: '{{ route('api.roles.restore', 'null') }}',
                                delete: '{{ route('api.roles.delete', 'null') }}',
                            },
                            restore: '{{ route('roles.restore', 'null') }}',
                            delete: '{{ route('roles.delete', 'null') }}',
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
                        const { sortBy, descending, page, rowsPerPage, totalItems } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                            trashedOnly: this.dataset.pagination.trashedOnly,
                        };

                        this.api().search('{{ route('api.roles.search') }}', query)
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
                    this.api().get('{{ route('api.roles.all') }}', this.dataset.pagination)
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
                            console.log(data);
                            self.get('{{ route('api.roles.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.items);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.roles.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data);
                            self.snackbar.model = true;
                        });
                },

                setDialog (model, data) {
                    this.resource.dialog.model = model;
                    this.resource.dialog.data = data;
                },
            },

            mounted () {
                this.get();
            },
        });
    </script>
@endpush

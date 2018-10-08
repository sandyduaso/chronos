@extends("Frontier::layouts.admin")

@section("head-title", __('Permissions'))

@section("content")
    @include("Frontier::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8 xs12>
                <v-card class="mb-3">
                    <v-toolbar dark class="secondary elevation-1">
                        <v-icon left dark>lock</v-icon>
                        <v-toolbar-title>{{ __('Permissions') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    {{-- search --}}
                    <v-text-field
                        solo
                        label="Search"
                        append-icon=""
                        prepend-icon="search"
                        class="pa-2 elevation-1 search-bar"
                        v-model="dataset.searchform.query"
                        clearable
                    ></v-text-field>
                    {{-- /search --}}

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
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
                            <td>@{{ prop.item.id }}</td>
                            <td><strong v-tooltip:bottom="{'html': prop.item.description}">@{{ prop.item.name }}</strong></td>
                            <td>@{{ prop.item.code }}</td>
                            <td>@{{ prop.item.description }}</td>
                            <td>@{{ prop.item.created }}</td>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>
            <v-flex sm4 xs12>
                <v-card class="mb-3">
                    <v-card-title><strong>{{ __("Refresh Permissions") }}</strong></v-card-title>
                    <v-card-text>
                        <form action="{{ route('permissions.refresh.refresh') }}" method="POST">
                            {{ csrf_field() }}
                            <p class="grey--text text-sm-right">{{ __("Refreshing will add and/or update all new permissions specified by the modules you've installed. Existing permissions will not be removed.") }}</p>

                            <div class="text-sm-right">
                                <v-btn type="submit" class="success--text" flat v-tooltip:left="{html: 'Doing this action is relatively safe'}">Refresh
                                </v-btn>
                            </div>
                        </form>
                    </v-card-text>
                </v-card>

                {{-- @can("reset-permission") --}}
                <v-card class="elevation-1">
                    <v-card-title><strong>{{ __("Reset Permissions") }}</strong></v-card-title>
                    <v-card-text>
                        <form id="reset-permissions-form" action="{{ route('permissions.reset.reset') }}" method="POST" class="text-sm-right">
                            {{ csrf_field() }}
                            <p class="grey--text">{{ __("Resetting will remove all existing permissions from the database. Then it will re-populate the database with all of the permissions defined from the modules you've installed. Doing this will not reset the roles you've created - you have to manually redefine each roles again. Proceed with caution!") }}</p>

                            <v-dialog v-model="permissions.dialog.model" transition="scale-transition" persistent lazy width="500">
                                <v-btn flat class="error--text" slot="activator"><span v-tooltip:left="{'html': 'Caution: This action is irreversible'}">Reset</span></v-btn>
                                <v-card class="elevation-4 text-xs-center">
                                    <v-card-text>
                                        <div class="headline ma-2"><v-icon round class="warning--text display-4">info_outline</v-icon></div>
                                    </v-card-text>
                                    <v-card-text>
                                        {{ __("Performing this action will completely remove all Permissions data. The Application might not work properly after this action. You might need to setup the Users' Roles, Grants, and Permissions manually again. If you do not want to upset the order of the Cosmos, then for the love of Talos, do not proceed!") }}
                                    </v-card-text>

                                    <v-card-text class="text-xs-center"><strong>{{ __("Would you like to proceed?") }}</strong></v-card-text>

                                    <v-card-actions class="pa-3">
                                        <v-btn flat @click.native="permissions.dialog.model = false">{{ __('No, Cancel') }}</v-btn>
                                        <v-spacer></v-spacer>
                                        <v-btn class="elevation-0 ma-0 error--text" flat @click.native="proceed()">{{ __('Skyrim belongs to the Nords! (Reset)') }}</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>

                        </form>
                    </v-card-text>
                </v-card>
                {{-- @endcan --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .search-bar label{
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 25px !important;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: {{ settings('items_per_page', 15) }},
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                    permissions: {
                        dialog: {
                            model: false,
                        },
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
                        };

                        this.api().search('{{ route('api.permissions.search') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },
            methods: {
                proceed () {
                    document.getElementById("reset-permissions-form").submit();
                },

                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.permissions.all') }}', query)
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
        });
    </script>
@endpush

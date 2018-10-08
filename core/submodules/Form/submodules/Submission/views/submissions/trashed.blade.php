@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.commands.model"
                            :class="bulk.commands.model ? 'btn--active error grey--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checkboxes') }}'}"
                            @click.native="bulk.commands.model = !bulk.commands.model"
                        ><v-icon>@{{ bulk.commands.model ? 'delete' : 'check_circle' }}</v-icon></v-btn>

                        {{-- Bulk Restore --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form :action="route(urls.submissions.restore, false)" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="id[]" :value="item.id">
                                    </template>
                                    <v-btn flat icon type="submit" v-tooltip:left="{'html': `Restore ${dataset.selected.length} selected items`}"><v-icon success>restore</v-icon></v-btn>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- Bulk Restore --}}

                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <v-dialog transition="scale-transition" persistent v-model="dataset.dialog.model" lazy width="auto">
                                    <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}">
                                        <v-icon class="error--text">delete_forever</v-icon>
                                    </v-btn>
                                    <v-card class="elevation-4 text-xs-center">
                                        <v-card-text class="pa-5">
                                            <p class="headline ma-2"><v-icon round class="warning--text display-4">info_outline</v-icon></p>
                                            <h2 class="display-1 grey--text text--darken-2"><strong>{{ __('Are you sure?') }}</strong></h2>
                                            <div class="grey--text text--darken-1">
                                                <div class="mb-1">{{ __("You are about to permanently delete those resources.") }}</div>
                                                <div>{{ __("This action is irreversible. Do you want to proceed?") }}</div>
                                            </div>
                                        </v-card-text>
                                        <v-divider></v-divider>
                                        <v-card-actions class="pa-3">
                                            <v-btn class="grey--text grey lighten-2 elevation-0" flat @click.native.stop="dataset.dialog.model=false">{{ __('Cancel') }}</v-btn>
                                            <v-spacer></v-spacer>
                                            <form :action="route(urls.submissions.delete, false)" method="POST" class="inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <template v-for="item in dataset.selected">
                                                <input type="hidden" name="id[]" :value="item.id">
                                            </template>
                                            <v-btn class="elevation-0 ma-0 error white--text" type="submit">
                                                {{ __('Yes, delete it!') }}
                                            </v-btn>
                                            </form>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </template>
                        </v-slide-y-transition>
                        {{-- Bulk Delete --}}

                        {{-- Batch Commands --}}

                    </v-toolbar>

                    {{-- search --}}
                    <v-text-field
                        solo
                        label="Search"
                        append-icon=""
                        prepend-icon="search"
                        class="pa-2 elevation-0 search-bar"
                        v-model="dataset.searchform.query"
                        clearable
                    ></v-text-field>
                    {{-- /search --}}

                    <v-divider></v-divider>

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.pagination.totalItems"
                        class="elevation-0 grey--text"
                        no-data-text="{{ __('No resource found') }}"
                        v-bind="bulk.commands.model?{'select-all':'primary'}:{}"
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected">
                        <template slot="items" scope="prop">
                            <td class="grey--text text--darken-1" v-show="bulk.commands.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.id"></td>
                            <td class="grey--text text--darken-1"><strong v-html="prop.item.title"></strong></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.code"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.author"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.template"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.created"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.removed"></td>
                            <td class="grey--text text--darken-1 text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:left="{html: 'More Actions'}"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple @click="$refs[`restore_${prop.item.id}`].submit()">
                                            <v-list-tile-action>
                                                <v-icon class="success--text">restore</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form :id="`restore_${prop.item.id}`" :ref="`restore_${prop.item.id}`" :action="route(urls.submissions.restore, prop.item.id)" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PATCH') }}
                                                        {{ __('Restore') }}
                                                    </form>
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="setDialog(true, prop.item)">
                                            <v-list-tile-action>
                                                <v-icon error>delete_forever</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Delete Permanently') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>

                                            <v-dialog transition="scale-transition" v-model="resource.dialog.model" persistent width="400px" min-width="150px" max-width="400px">
                                                <v-card class="text-xs-center elevation-4">
                                                    <v-card-text class="pa-5">
                                                        <p class="headline ma-2"><v-icon round class="warning--text display-4">info_outline</v-icon></p>
                                                        <h2 class="display-1 grey--text text--darken-2"><strong>{{ __('Are you sure?') }}</strong></h2>
                                                        <div class="grey--text text--darken-1">
                                                            <span class="mb-3">{{ __("You are about to permanently delete") }} <strong><em>@{{ prop.item.title }}</em></strong>.</span>
                                                            <span>{{ __("This action is irreversible. Do you want to proceed?") }}</span>
                                                        </div>
                                                    </v-card-text>
                                                    <v-divider></v-divider>
                                                    <v-card-actions class="pa-3">
                                                        <v-btn class="grey--text grey lighten-2 elevation-0" @click.native="resource.dialog.model=false">
                                                            {{ __('Cancel') }}
                                                        </v-btn>
                                                        <v-spacer></v-spacer>
                                                        <form
                                                            :id="`delete_${prop.item.id}`" :ref="`delete_${prop.item.id}`"
                                                            :action="route(urls.submissions.delete, prop.item.id)" method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                            <v-btn @click="$refs[`delete_${prop.item.id}`].submit()" class="elevation-0 ma-0 error white--text">{{ __('Yes, delete it!') }}</v-btn>
                                                        </form>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    item: '',
                    resource: {
                        dialog: {
                            model: false,
                        },
                        item: '',
                    },
                    bulk: {
                        commands: {
                            model: false,
                        },
                    },
                    urls: {
                        submissions: {
                            restore: '{{ route('submissions.restore', 'null') }}',
                            delete: '{{ route('submissions.delete', 'null') }}',
                        }
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'title' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Template") }}', align: 'left', value: 'template' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Removed") }}', align: 'left', value: 'deleted_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        dialog: {
                            model: false
                        },
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
                            search: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                            only_trashed: true,
                        };

                        this.api().search('{{ route('api.submissions.all') }}', query)
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
                        only_trashed: true,
                    };
                    this.api().get('{{ route('api.submissions.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.pagination.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                setDialog (model, data) {
                    this.resource.dialog.model = model;
                    this.resource.dialog.data = data;
                },
            },

            mounted () {
                this.get();
            }
        });
    </script>
@endpush

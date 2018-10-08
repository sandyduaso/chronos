@extends("Theme::layouts.admin")

@section("content")

<v-toolbar dark class="sticky secondary elevation-1">
    <v-icon left dark>find_in_page</v-icon>
    <v-toolbar-title>{{ __('Pages') }}</v-toolbar-title>

    <v-spacer></v-spacer>

    {{-- create --}}
    <v-btn
        icon
        href="{{ route('pages.create') }}"
        v-tooltip:left="{ html: 'Create' }"
        >
        <v-icon>add</v-icon>
    </v-btn>
    {{-- /create --}}

    {{-- Batch Commands --}}
    <v-btn
        v-show="dataset.selected.length < 2"
        flat
        icon
        v-model="bulk.destroy.model"
        :class="bulk.destroy.model ? 'btn--active warning warning--text' : ''"
        v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
        @click.native="bulk.destroy.model = !bulk.destroy.model"
    ><v-icon>check_circle</v-icon></v-btn>
    {{-- Bulk Delete --}}
    <v-slide-y-transition>
        <template v-if="dataset.selected.length > 1">
            <form :action="route(urls.pages.destroy, false)" method="POST" class="inline">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <template v-for="item in dataset.selected">
                    <input type="hidden" name="id[]" :value="item.id">
                </template>
                <v-btn flat icon type="submit" v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"><v-icon warning>delete_sweep</v-icon></v-btn>
            </form>
        </template>
    </v-slide-y-transition>
    {{-- /Bulk Delete --}}
    {{-- /Batch Commands --}}

    {{-- Trashed --}}
    <v-btn
        icon
        flat
        href="{{ route('pages.trashed') }}"
        v-tooltip:left="{'html': `View trashed items`}"
    ><v-icon>archive</v-icon></v-btn>
    {{-- /Trashed --}}
</v-toolbar>

<v-container fluid grid-list-lg>
    <v-layout row wrap>
        <v-flex xs12>

            <v-card class="mb-3 elevation-1">
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
                    v-bind="bulk.destroy.model?{'select-all':'primary'}:[]"
                    :rows-per-page-items="dataset.pagination.rowsPerPageItems"
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
                        <td v-show="bulk.destroy.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                        <td v-html="prop.item.id"></td>
                        <td>
                            <v-avatar size="36px">
                                <img class="ma-1" height="100%" v-if="prop.item.feature" :src="prop.item.feature" :alt="prop.item.title">
                            </v-avatar>
                        </td>
                        <td><a class="secondary--text td-n" :href="route(urls.pages.edit, (prop.item.id))" class="td-n"><strong v-html="prop.item.title"></strong></a></td>
                        <td v-html="prop.item.code"></td>
                        <td><a :href="`{{ route('pages.index') }}?user_id=${prop.item.user_id}`" class="td-n black--text" v-html="prop.item.author"></a></td>
                        {{-- <td v-html="prop.item.author"></td> --}}
                        <td><a :href="`{{ route('pages.index') }}?template=${prop.item.template}`" class="td-n black--text" v-html="prop.item.template"></a></td>
                        <td v-html="prop.item.created"></td>
                        <td v-html="prop.item.modified"></td>
                        <td class="text-xs-center">
                            <v-menu bottom left>
                                <v-btn
                                    icon
                                    flat
                                    slot="activator"
                                    v-tooltip:left="{html: 'More Actions'}">
                                    <v-icon>more_vert</v-icon></v-btn>
                                <v-list>
                                    <v-list-tile :href="route(urls.pages.show, (prop.item.id))">
                                        <v-list-tile-action>
                                            <v-icon info>search</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                {{ __('View details') }}
                                            </v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile :href="route(urls.pages.edit, (prop.item.id))">
                                        <v-list-tile-action>
                                            <v-icon accent>edit</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                {{ __('Edit') }}
                                            </v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile ripple @click="$refs[`destroy_${prop.item.id}`].submit()">
                                        <v-list-tile-action>
                                            <v-icon warning>delete</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                <form :id="`destroy_${prop.item.id}`" :ref="`destroy_${prop.item.id}`" :action="route(urls.pages.destroy, prop.item.id)" method="POST">
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
            @if (request()->all())
                <v-btn error flat href="{{ route('pages.index') }}">
                    <v-icon left>remove_circle_outline</v-icon>
                    {{ __('Remove filter') }}
                </v-btn>
            @endif
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
                    bulk: {
                        destroy: {
                            model: false,
                        },
                    },
                    urls: {
                        pages: {
                            edit: '{{ route('pages.edit', 'null') }}',
                            show: '{{ route('pages.show', 'null') }}',
                            destroy: '{{ route('pages.destroy', 'null') }}',
                        }
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Feature") }}', align: 'left', value: 'feature' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'title' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Template") }}', align: 'left', value: 'template' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Modified") }}', align: 'left', value: 'modified_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPageItems: [5, 10, 15, 20, 30, {'value':50,text:50}, 100, {'value':'-1',text:'All'}],
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
                        console.log(this.dataset.pagination);
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            search: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.pages.all') }}', query)
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
                        search: {!! @json_encode(request()->all()) !!},
                    };
                    this.api().get('{{ route('api.pages.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },
        });
    </script>

@endpush

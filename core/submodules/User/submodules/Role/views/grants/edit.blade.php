@extends("Theme::layouts.admin")

@section("head-title", __('Edit Grant'))

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                {{ __($application->page->title) }}
            </h5>
            {{--  --}}
        </v-card-text>
    </v-layout>
@endpush

@section("content")

    <v-toolbar class="elevation-1 white sticky">
        <v-toolbar-title class="accent--text">{{ __('Edit Grant') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        @include("Theme::cards.save")
    </v-toolbar>

    @include("Theme::partials.banner")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="grey--text elevation-1 mb-2">
                    
                    <form ref="form" action="{{ route('grants.update', $resource->id) }}" method="POST">
                        <v-card-text>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="Name"
                                name="name"
                                value="{{ old('name') ? old('name') : $resource->name }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.code"
                                hint="{{ __('Will be used as an ID for Grants. Make sure the code is unique.') }}"
                                label="Code"
                                name="code"
                                :value="resource.item.name ? resource.item.name : '{{ old('code') ? old('code') : $resource->code }}' | slugify"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.description"
                                label="Description"
                                name="description"
                                value="{{ old('description') ? old('description') : $resource->description }}"
                            ></v-text-field>
                        </v-card-text>

                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-toolbar class="transparent elevation-0">
                                    <v-toolbar-title class="subheading">{{ __('Selected Permissions') }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-card-text class="text-xs-center">
                                    <template v-if="suppliments.permissions.selected.length">
                                        <template v-for="(permission, i) in suppliments.permissions.selected">
                                            <v-chip
                                                width="100px"
                                                label
                                                close
                                                success
                                                @click.native.stop
                                                @input="suppliments.permissions.selected.splice(i, 1)"
                                                class="chip--select-multi pink darken-3 white--text"
                                                :key="i"
                                            >
                                                <input type="hidden" name="json_permissions[]" :value="JSON.stringify(permission)">
                                                <input type="hidden" name="permissions[]" :value="permission.id">
                                                @{{ permission.name }}
                                            </v-chip>
                                        </template>
                                    </template>
                                    <small v-else class="grey--text">{{ __('No chosen Permissions') }}</small>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12>
                                <v-toolbar class="transparent elevation-0">
                                    <v-toolbar-title class="subheading">{{ __('Available Permissions') }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-text-field
                                        append-icon="search"
                                        label="{{ _('Search') }}"
                                        single-line
                                        hide-details
                                        v-model="suppliments.permissions.searchform.query"
                                        light
                                    ></v-text-field>
                                </v-toolbar>

                                <v-data-table
                                    class="elevation-0"
                                    no-data-text="{{ _('No resource found') }}"
                                    select-all
                                    selected-key="id"
                                    {{-- hide-actions --}}
                                    v-bind:search="suppliments.permissions.searchform.query"
                                    v-bind:headers="suppliments.permissions.headers"
                                    v-bind:items="suppliments.permissions.items"
                                    v-model="suppliments.permissions.selected"
                                    v-bind:pagination.sync="suppliments.permissions.pagination"
                                >
                                    <template slot="items" scope="prop">
                                        <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                                            <td>
                                                <v-checkbox
                                                    primary
                                                    hide-details
                                                    class="pa-0"
                                                    :input-value="prop.selected"
                                                ></v-checkbox>
                                            </td>
                                            <td>@{{ prop.item.name }}</td>
                                            <td>@{{ prop.item.code }}</td>
                                            <td>@{{ prop.item.description }}</td>
                                        </tr>
                                    </template>
                                </v-data-table>
                            </v-flex>
                        </v-layout>
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
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Description") }}', align: 'left', value: 'description' },
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
                        selected: {!! json_encode(old('permissions')) !!} ? {!! json_encode(old('permissions')) !!} : JSON.parse('{!! json_encode($resource->permissions) !!}'),
                        totalItems: 0,
                    },
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            permissions: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        dialog: {
                            model: false,
                        },
                    },
                    suppliments: {
                        permissions: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                                { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                                { text: '{{ __("Description") }}', align: 'left', value: 'description' },
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

            watch: {
                'dataset.pagination': {
                    handler () {
                        this.get();
                    },
                    deep: true
                },

                // 'dataset.searchform.query': function (filter) {
                //     setTimeout(() => {
                //         const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                //         let query = {
                //             descending: descending ? descending : false,
                //             page: page ? page : 1,
                //             q: filter,
                //             sort: sortBy ? sortBy : 'id',
                //             take: rowsPerPage,
                //         };

                //         this.api().search('{{ route('api.permissions.search') }}', query)
                //             .then((data) => {
                //                 this.dataset.items = data.items.data ? data.items.data : data.items;
                //                 this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                //                 this.dataset.loading = false;
                //             });
                //     }, 1000);
                // },
            },

            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy ? sortBy : 'name',
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.permissions.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                mountSuppliments () {
                    let items = {!! json_encode($permissions) !!};
                    let g = [];
                    for (var i in items) {
                        g.push({
                            id: items[i].id,
                            name: items[i].name,
                            code: items[i].code,
                            description: items[i].description,
                        });
                    }
                    this.suppliments.permissions.items = g;

                    let selected = {!! old('json_permissions') ? old('json_permissions') : json_encode($resource->permissions->pluck('code', 'id')) !!};
                    let s = [];
                    if (selected) {
                        for (var i in selected) {
                            s.push({
                                id: i,
                                name: selected[i],
                            });
                        }
                    }
                    this.suppliments.permissions.selected = s ? s : [];
                    console.log("dataset.pagination:", selected);
                },
            },

            mounted () {
                this.get();
                this.mountSuppliments();
            }
        });
    </script>
@endpush

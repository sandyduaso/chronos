@extends("Theme::layouts.admin")

@section("head-title", __('Grants'))

@section("content")
    @include("Theme::partials.banner")

    <v-slide-y-transition>
        <v-card class="transparent" flat>   
            <form action="{{ route('grants.refresh.refresh') }}" method="POST" style="background: linear-gradient(45deg, #009688 0%, #3657aa 100%);"  >
                {{ csrf_field() }}

                <v-toolbar class="transparent" flat>
                    <v-spacer></v-spacer>
                    <v-btn dark icon @click.native="grant = !grant" v-tooltip:left="{ 'html':  grant ? 'Show' : 'Hide' }">
                        <v-icon>@{{ grant ? 'visibility' : 'visibility_off' }}</v-icon>
                    </v-btn>
                </v-toolbar> 
                <v-layout column class="media" v-show="!grant" transition="slide-y-transition">
                    <v-card-text class="white--text text-xs-center">
                        <v-flex md8 offset-md2 class="pt-5 pb-5">
                            <div class="title pb-3"> {{ __('Automatic Grant-Permission Provisioning') }} </div>
                            <div class="subheading pb-3">{{ __("Performing this action will automate most of the process of creating and grouping a collection of permissions into Grants. It will base its provisioning on the permissions configuration on each Modules installed.") }}
                            </div>
                            <div class="subheading white--text pb-4">
                                {{ __("Any edit you've made from existing grants might get overridden.") }}
                            </div>
                                <v-btn outline dark type="submit" v-tooltip:left="{'html': 'Doing this action is relatively safe'}">
                                    {{ __('Start') }}
                                </v-btn>
                        </v-flex>
                    </v-card-text>
                </v-layout>
            </form>
        </v-card>
    </v-slide-y-transition>

    <v-toolbar dark class="secondary elevation-1 sticky">
        <v-icon left dark>lock_open</v-icon>
        <v-toolbar-title>{{ __('Grants') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click.native="hidden = !hidden" v-tooltip:left="{ 'html':  hidden ? 'Add' : 'Close' }">
            <v-icon>@{{ hidden ? 'add' : 'remove' }}</v-icon>
        </v-btn>


        {{-- Batch Commands --}}
        <v-btn
            v-show="dataset.selected.length < 2"
            flat
            icon
            v-model="bulk.destroy.model"
            :class="bulk.destroy.model ? 'btn--active primary primary--text' : ''"
            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checkboxes') }}'}"
            @click.native="bulk.destroy.model = !bulk.destroy.model"
        ><v-icon>@{{ bulk.destroy.model ? 'check_circle' : 'check_circle' }}</v-icon></v-btn>

        {{-- Bulk Delete --}}
        <v-slide-y-transition>
            <template v-if="dataset.selected.length > 1">
                <form action="{{ route('grants.destroy', 'false') }}" method="POST" class="inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <template v-for="item in dataset.selected">
                        <input type="hidden" name="id[]" :value="item.id">
                    </template>
                    <v-btn
                        flat
                        icon
                        type="submit"
                        v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"
                    ><v-icon warning>delete_sweep</v-icon></v-btn>
                </form>
            </template>
        </v-slide-y-transition>
        {{-- /Bulk Delete --}}
        {{-- /Batch Commands --}}
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                {{-- create field --}}
                <v-slide-y-transition>
                    <v-card class="mb-3 elevation-1" v-show="!hidden" transition="slide-y-transition">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __("New Grant") }}</v-toolbar-title>
                        </v-toolbar>
                            <form action="{{ route('grants.store') }}" method="POST">
                            <v-card-text>
                                {{ csrf_field() }}
                                <v-layout row wrap>
                                    <v-flex xs4>
                                        <v-subheader>{{ __('Name') }}</v-subheader>
                                    </v-flex>
                                    <v-flex xs8>
                                        <v-text-field
                                        :error-messages="resource.errors.name"
                                        label="{{ _('Name') }}"
                                        name="name"
                                        persistent-hint
                                        value="{{ old('name') }}"
                                        @input="val => { resource.item.name = val; }"
                                    ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4>
                                        <v-subheader>{{ __('Code') }}</v-subheader>
                                    </v-flex>
                                    <v-flex xs8>
                                        <v-text-field
                                            :error-messages="resource.errors.code"
                                            :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                                            hint="{{ __('Will be used as an ID for Granting Grants. Make sure the code is unique.') }}"
                                            label="{{ _('Code') }}"
                                            name="code"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4>
                                        <v-subheader>{{ __('Description') }}</v-subheader>
                                    </v-flex>
                                    <v-flex xs8>
                                        <v-text-field
                                            :error-messages="resource.errors.description"
                                            label="{{ _('Short Description') }}"
                                            name="description"
                                            value="{{ old('description') }}"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-text>
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
                                                        class="chip--select-multi green lighten-2 white--text"
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
                                            class="elevation-0 green--text"
                                            no-data-text="{{ _('No resource found') }}"
                                            select-all="green lighten-2"
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
                                                            class="pa-0 green--text text--lighten-2"
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

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn primary type="submit">{{ __('Save') }}</v-btn>
                                </v-card-actions>
                            </form>
                        </v-card-text>
                    </v-card>
                </v-slide-y-transition>
                {{-- /create field --}}

                <v-card class="elevation-1">
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
                                    primary
                                    class="pa-0 primary--text"
                                    v-model="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td>@{{ prop.item.id }}</td>
                            <td>
                                <a class="secondary--text ripple no-decoration" :href="route(urls.grants.edit, prop.item.id)">
                                   <strong v-tooltip:bottom="{ html: 'Edit Detail' }">@{{ prop.item.name }}</strong>
                                </a>
                            </td>
                            <td>@{{ prop.item.code }}</td>
                            <td>@{{ prop.item.excerpt }}</td>
                            <td class="text-xs-center">
                                <span v-tooltip:bottom="{'html': 'Number of permissions associated'}">@{{ prop.item.permissions.length }}</span>
                            </td>
                            <td>@{{ prop.item.created }}</td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:left="{html: 'More Actions'}"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile :href="route(urls.grants.show, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon info>search</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('View details') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile :href="route(urls.grants.edit, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile @click="post(route(urls.grants.api.clone, (prop.item.id)))">
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
                                            @click="destroy(route(urls.grants.api.destroy, prop.item.id),
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

@push('css')
    <style>
        .no-decoration {
            text-decoration: none !important;
        }
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
        .weight-600 {
            font-weight: 600 !important;
        }
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
                    bulk: {
                        destroy: {
                            model: false,
                        },
                        searchform: {
                            model: false,
                        },
                    },
                    hidden: true,
                    grant: false,
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                            { text: '{{ __("Permissions") }}', align: 'center', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            take: 5,
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
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    suppliments: {
                        permissions: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                                { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                                { text: '{{ __("Description") }}', align: 'left', value: 'description' },
                            ],
                            pagination: {
                                rowsPerPage: 10,
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
                        grants: {
                            api: {
                                clone: '{{ route('api.grants.clone', 'null') }}',
                                destroy: '{{ route('api.grants.destroy', 'null') }}',
                            },
                            show: '{{ route('grants.show', 'null') }}',
                            edit: '{{ route('grants.edit', 'null') }}',
                            destroy: '{{ route('grants.destroy', 'null') }}',
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
                        this.get('{{ route('api.grants.all') }}');
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

                        this.api().search('{{ route('api.grants.search') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },
            methods: {
                get (url) {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.grants.all') }}', query)
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
                            self.get('{{ route('api.grants.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.grants.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
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

                    let selected = {!! json_encode(old('json_permissions')) !!};
                    console.log(selected);
                    let s = [];
                    if (selected) {
                        for (var i in selected) {
                            let instance = JSON.parse(selected[i]);
                            s.push({
                                id: instance.id,
                                name: instance.name,
                            });
                        }
                    }
                    this.suppliments.permissions.selected = s ? s : [];
                },
            },

            mounted () {
                this.get('{{ route('api.grants.all') }}');
                this.mountSuppliments();
                // this.dataset.pagination.rowsPerPage = this.dataset.totalItems <= 15 ? '-1' : this.dataset.totalItems;
            }
        });
    </script>
@endpush

@push('js')
    <script>
    </script>
@endpush

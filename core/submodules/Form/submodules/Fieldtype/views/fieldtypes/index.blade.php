@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 xs12>
                <form action="{{ route('fieldtypes.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1">
                        <v-toolbar flat class="transparent">
                            <v-toolbar-title class="subheading">{{ __("New Fieldtype") }}</v-toolbar-title>
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
                                :error-messages="resource.errors.template"
                                label="{{ __('Template') }}"
                                name="template"
                                v-model="resource.item.template"
                                multi-line
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions class="pa-3">
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>

            <v-flex sm9 xs12>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar flat class="transparent">
                        <v-icon left>text_format</v-icon>
                        <v-toolbar-title class="subheading">{{ __('All Fieldtype Categories') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.commands.model"
                            :class="bulk.commands.model ? 'btn--active error grey--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
                            @click.native="bulk.commands.model = !bulk.commands.model"
                        ><v-icon>@{{ bulk.commands.model ? 'delete' : 'check_circle' }}</v-icon></v-btn>

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
                                            <form :action="route(urls.fieldtypes.destroy, false)" method="POST" class="inline">
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
                            <td><a class="td-n secondary--text" :href="route(urls.fieldtypes.edit, (prop.item.id))"><strong v-html="prop.item.name"></strong></a></td>
                            <td v-html="prop.item.code"></td>
                            {{-- <td v-html="prop.item.alias"></td> --}}
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:left="{html: 'More Actions'}"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple @click="setDialog(true, prop.item)">
                                            <v-list-tile-action>
                                                <v-icon error>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                {{ __('Delete Permanently') }}
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
                                                            :action="route(urls.fieldtypes.destroy, prop.item.id)" method="POST">
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
                        dialog: {
                            model: false
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },

                    bulk: {
                        commands: {
                            model: false,
                        },
                    },

                    urls: {
                        fieldtypes: {
                            edit: '{{ route('fieldtypes.edit', 'null') }}',
                            destroy: '{{ route('fieldtypes.destroy', 'null') }}',
                        }
                    },

                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Modified") }}', align: 'left', value: 'modified_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        dialog: {
                            model: false,
                        },
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

                        this.api().search('{{ route('api.fieldtypes.search') }}', query)
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
                    this.api().get('{{ route('api.fieldtypes.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
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
        })
    </script>
@endpush

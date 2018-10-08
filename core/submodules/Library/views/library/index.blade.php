@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar class="secondary elevation-1 sticky" dark>
        <template v-if="dataset.searchform.model">
            <v-text-field
                prepend-icon="search"
                append-icon="close"
                :append-icon-cb="() => searchbox().close()"
                light solo hide-details single-line
                v-model="dataset.searchform.query"></v-text-field>
        </template>
        <template v-else>
            <v-menu :nudge-width="100">
                <v-toolbar-title slot="activator">
                    <v-icon class="white--text pr-2" v-html="suppliments.catalogues.current.icon">view_module</v-icon>
                    <span v-html="suppliments.catalogues.current.name"></span>
                    <v-icon dark>arrow_drop_down</v-icon>
                </v-toolbar-title>
                <v-list>
                    <v-list-tile @click="supplimentary().select(item)" ripple v-for="(item, i) in suppliments.catalogues.items" :key="i">
                        <v-list-tile-action>
                            <v-icon accent v-html="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title v-html="item.name"></v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-chip class="blue white--text" label v-html="item.libraries?item.libraries.length:item.count"></v-chip>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-spacer></v-spacer>
            <span class="caption" v-if="bulk.selection.model" v-html="`${dataset.selected.length}/${dataset.pagination.totalItems} Selected`"></span>
            <v-spacer v-if="bulk.selection.model"></v-spacer>

            {{-- Search --}}
            <v-btn
                icon
                v-tooltip:left="{ html: 'Search' }"
                @click="dataset.searchform.model = !dataset.searchform.model"
            >
                <v-icon>search</v-icon>
            </v-btn>
            {{-- /Search --}}
        </template>

        <v-btn icon v-tooltip:left="{ html: 'Upload files' }" :class="bulk.upload.model ? 'btn--active primary' : ''" @click.native.stop="setStorage('bulk.upload.model', (bulk.upload.model = !bulk.upload.model))">
            <v-icon>fa-cloud-upload</v-icon>
        </v-btn>

        {{-- Selection --}}
        <v-btn v-model="bulk.selection.model" :class="{'primary': bulk.selection.model}" ripple @click="bulk.selection.model = !bulk.selection.model; bulk.selection.model?bulk.toggle.model = true : null" icon v-tooltip:left="{ html: 'Toggle Bulk Selection' }">
            <v-icon>check_circle</v-icon>
        </v-btn>
        <template v-if="bulk.selection.model && dataset.selected.length > 1">
            <form action="{{ route('library.many.destroy') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="hidden" name="library[]" v-for="(selected, i) in dataset.selected" :key="i" :value="selected.id">
                <v-btn type="submit" small ripple @click="datasetbox().trash()" icon class="white" v-tooltip:left="{html:'{{ __('Move to Trash') }}'}"><v-icon class="error--text">delete</v-icon></v-btn>
            </form>
            {{-- <v-btn small icon v-tooltip:left="{html:'{{ __('Download') }}'}"><v-icon>cloud_download</v-icon></v-btn> --}}
        </template>
        {{-- /Selection --}}

        <v-btn icon v-tooltip:left="{html: 'Grid / List'}" @click="bulk.toggle.model = !bulk.toggle.model">
            <v-icon small v-if="!bulk.toggle.model">view_module</v-icon>
            <v-icon small v-else>list</v-icon>
        </v-btn>

        <v-menu transition="slide-y-transition" v-if="!bulk.toggle.model">
            <v-btn icon slot="activator" v-tooltip:left="{html: 'Filter'}">
                <v-icon>filter_list</v-icon>
            </v-btn>
            <v-card>
                <v-list>
                    <v-list-tile
                        href="" ripple @click="datasetbox().sortBy(header)"
                        v-for="(header, i) in dataset.headers"
                        :disabled="typeof header.sortable != 'undefined' && !header.sortable"
                        :key="i"
                    >
                        <v-list-tile-title v-html="header.text"></v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-card>
        </v-menu>
        <v-btn ripple v-if="!bulk.toggle.model" icon v-tooltip:left="{html: 'Sort'}" @click="datasetbox().sort()">
            <v-icon class="subheading" v-if="dataset.pagination.descending">fa-sort-amount-desc</v-icon>
            <v-icon class="subheading" v-else>fa-sort-amount-asc</v-icon>
        </v-btn>
        {{-- v-if="!bulk.toggle.model" --}}
        <v-menu :nudge-width="100" transition="slide-y-transition" >
            <span flat class="px-2" slot="activator" v-tooltip:left="{html: 'Rows per page'}">
                <span v-html="dataset.pagination.rowsPerPageText"></span>
                <v-icon dark>arrow_drop_down</v-icon>
            </span>
            <v-card>
                <v-list>
                    <v-list-tile
                        href="" ripple @click="datasetbox().rowsPerPage(row)"
                        v-for="(row, i) in dataset.rowsPerPageItems"
                        :key="i"
                    >
                        <v-list-tile-title class="text-xs-right" v-html="typeof row.text != 'undefined' ? row.text : row"></v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-card>
        </v-menu>
    </v-toolbar>

    <v-slide-y-transition>
        <v-card flat tile v-show="bulk.upload.model" class="grey lighten-4">
            <v-dropzone
                :options="{url: '{{ route('api.library.upload') }}', timeout: '120s', autoProcessQueue: true, parallelUploads: 1 }"
                :params="dropzone.params"
                auto-remove-files
                @complete="dropzonebox().completed($event)"
                @sending="dropzonebox().sending($event)"
            >
                <template>
                    <div class="caption grey--text text--darken-2">
                        <span>{{ __('You may drag 20 files at a time.') }}</span>
                        <em class="caption" v-html="`{{ __('Uploads will be catalogued as') }} <strong>${suppliments.catalogues.current.name}</strong>`"></em>
                    </div>
                    <v-switch label="Extract archive files" persistent-hint v-model="dropzone.extract" value="true"></v-switch>
                    <input type="hidden" name="extract" :value="dropzone.extract">
                </template>
            </v-dropzone>
        </v-card>
    </v-slide-y-transition>

    <v-container fluid v-if="dataset.loading">
        <v-layout fill-height row wrap>
            <v-flex xs12 class="text-xs-center">
                <v-progress-circular :size="75" indeterminate class="grey--text"></v-progress-circular>
            </v-flex>
        </v-layout>
    </v-container>

    <v-container fluid class="grey lighten-4" grid-list-lg v-if="!dataset.items.length && !bulk.upload.model">
        <v-layout fill-height row wrap>
            <v-flex xs12>
                <div class="text-xs-center grey--text">
                    <v-icon class="display-4 grey--text">fa-frown-o</v-icon>
                    <div class="mb-3">{{ __('There seems to be only loneliness here.') }}</div>
                    <div><v-btn info class="elevation-1" @click="bulk.upload.model = !bulk.upload.model">{{ __('Upload') }}</v-btn></div>
                </div>
            </v-flex>
        </v-layout>
    </v-container>

    <v-container fluid class="grey lighten-4" grid-list-lg>
        <v-layout fill-height row wrap>
            <v-flex sm12>
                <v-dataset
                    :card="!bulk.toggle.model"
                    :headers="dataset.headers"
                    :items="dataset.items"
                    :pagination="dataset.pagination"
                    :rows-per-page-items="dataset.rowsPerPageItems"
                    :table="bulk.toggle.model"
                    :total-items="dataset.pagination.totalItems"
                    item-key="id"
                    item-name="name"
                    pagination-both
                    pagination-circle
                    v-bind="bulk.selection.model?{'select-all':'primary'}:null"
                    v-model="dataset.selected"
                    @pagination="datasetbox().pagination($event)"
                    >
                    <template slot="items" scope="{prop}">
                        <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                            <td v-if="bulk.selection.model">
                                <v-checkbox
                                    color="primary"
                                    primary
                                    hide-details
                                    :input-value="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td v-html="prop.item.id"></td>
                            <td>
                                <v-avatar size="35px">
                                    <img :src="prop.item.thumbnail">
                                </v-avatar>
                                <span v-html="prop.item.name"></span>
                            </td>
                            <td><v-chip class="red lighten-3 white--text"><v-icon left class="white--text" v-html="prop.item.icon"></v-icon><span v-html="prop.item.mimetype"></span></v-chip></td>
                            <td v-html="prop.item.filesize"></td>
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                        </tr>
                    </template>
                    <template slot="card" scope="{prop}">
                        <v-card-media height="200px" :src="prop.item.thumbnail" class="grey lighten-4">
                            <v-container fill-height class="pa-0 white--text">
                                <v-layout fill-height wrap column>
                                    <div class="text-xs-right pa-2">
                                        <v-menu bottom left>
                                            <v-btn v-tooltip:left="{ html: 'More Action' }" icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                                            <v-list>
                                                <v-list-tile ripple @click="$refs[`destroy_${prop.item.id}`].submit()">
                                                   <v-list-tile-action>
                                                       <v-icon warning>delete</v-icon>
                                                   </v-list-tile-action>
                                                   <v-list-tile-content>
                                                       <v-list-tile-title>
                                                           <form :id="`destroy_${prop.item.id}`" :ref="`destroy_${prop.item.id}`" :action="route(urls.library.destroy, prop.item.id)" method="POST">
                                                               {{ csrf_field() }}
                                                               {{ method_field('DELETE') }}
                                                               {{ __('Move to Trash') }}
                                                           </form>
                                                       </v-list-tile-title>
                                                   </v-list-tile-content>
                                               </v-list-tile>
                                            </v-list>
                                        </v-menu>
                                    </div>
                                </v-layout>
                            </v-container>
                        </v-card-media>
                        {{-- <v-divider></v-divider> --}}
                        <v-toolbar card dense class="transparent py-2">
                            <v-toolbar-title class="subheading mt-4 mx-3">
                                <span class="body-1" v-html="prop.item.name"></span>
                                <div class="caption grey--text" v-html="prop.item.filesize"></div>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn small absolute fab top right class="info darken-1 elevation-1"><v-icon class="white--text" v-html="prop.item.icon"></v-icon></v-btn>
                        </v-toolbar>
                        <v-card-actions class="grey--text px-2">
                            <span class="caption" v-html="prop.item.mimetype"></span>
                            <v-spacer></v-spacer>
                            <div class="caption text-xs-right" v-html="prop.item.created"></div>
                        </v-card-actions>
                    </template>
                </v-dataset>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-dataset/dist/vuetify-dataset.min.css') }}">
    <link rel="stylesheet" href="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-dataset/dist/vuetify-dataset.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        upload: {
                            model: false,
                        },
                        toggle: {
                            model: false,
                        },
                        selection: {
                            model: false,
                        },
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            // { text: '{{ __("Thumbnail") }}', align: 'left', value: 'thumbnail' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("File Type") }}', align: 'left', value: 'mimetype' },
                            { text: '{{ __("File Size") }}', align: 'left', value: 'size' },
                            { text: '{{ __("Upload Date") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: '{{ settings('items_per_page', 15) }}',
                            rowsPerPageText: 10,
                            totalItems: 0,
                            sortBy: 'id',
                            descending: false,
                        },
                        rowsPerPageItems: [5, 10, 15, 25, { text: "All", value: -1 }],
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                    },
                    suppliments: {
                        catalogues: {
                            current: {},
                            items: [],
                        }
                    },

                    urls: {
                        library: {
                            catalogue: '{{ route('api.library.catalogue', 'null') }}',
                            index: '{{ route('library.index') }}',
                            destroy: '{{ route('library.destroy', 'null') }}',
                        },
                    },

                    dropzone: {
                        currentfile: {},
                        extract: true,
                        params: {
                            _token: '{{ csrf_token() }}',
                        },
                    }
                };
            },

            watch: {
                'dataset.searchform.query': function (q) {
                    // console.log('se', q)
                    this.search('{{ route('api.library.search') }}', q)
                }
            },

            methods: {
                search (url, q) {
                    let self = this;

                    setTimeout(function () {
                        self.dataset.loading = true

                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        let query = {
                            descending: descending?descending:true,
                            page: page?page:1,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage,
                            _token: '{{ csrf_token() }}',
                            q: q
                        };

                        self.api().search(url, query)
                            .then((data) => {
                                self.dataset.items = data.items.data ? data.items.data : data.items;
                                self.dataset.pagination.totalItems = data.items.total ? data.items.total : data.total;
                                self.dataset.loading = false;
                                self.dataset.items.map(item => {
                                    self.$set(item, 'active', false);
                                });
                                self.dataset.loading = false;
                                // console.log('searc',self.dataset)
                            });
                    }, 1000)
                },
                get (url, query) {
                    let self = this;
                    // self.dataset.loading = true;

                    if (typeof query == 'undefined') {
                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        let query = {
                            descending: descending?descending:true,
                            page: page?page:1,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage?rowsPerPage:10,
                            _token: '{{ csrf_token() }}'
                        };
                    }

                    // self.$set(self.dataset, 'pagination', query)

                    console.log('url', url, query)
                    self.api().get(url, query)
                        .then((data) => {
                            self.dataset.items = data.items.data ? data.items.data : data.items;
                            self.dataset.pagination.totalItems = data.items.total ? data.items.total : data.total;
                            self.dataset.loading = false;
                            self.dataset.items.map(item => {
                                self.$set(item, 'active', false);
                            });
                            self.mountSuppliments();
                            // self.dataset.loading = false;
                            // console.log(self.dataset)
                        });
                },

                mountSuppliments () {
                    // this.suppliments.catalogues.current = '{{ request()->getQueryString() }}';

                    // this.api().get('{{ route('api.library.catalogues') }}')
                    //     .then((data) => {
                    //         console.log(data);
                    //         this.suppliments.catalogues.items = data.items.data ? data.items.data : data.items;
                    //         for (var i = this.suppliments.catalogues.items.length - 1; i >= 0; i--) {
                    //             let current = this.suppliments.catalogues.items[i];
                    //             if (current.id == this.suppliments.catalogues.current.split('=')[1]) {
                    //                 this.suppliments.catalogues.items[i].active = true;
                    //             }
                    //         }
                    //     });

                },

                storage () {
                    // this.bulk.upload.model = this.getStorage('bulk.upload.model') === 'true';
                },

                complete (file, dropzone) {
                    self.supplimentary().select(self.suppliments.catalogues.current);
                },

                supplimentary () {
                    let self = this;

                    return {
                        mount (items) {
                            self.suppliments.catalogues.items.push({name:'{{ __('All') }}', code: 'all', icon: 'perm_media', count: '{{ $resources->count() }}'});

                            for (var i = 0; i < items.length; i++) {
                                items[i].count = items[i].count ? items[i].count : items[i].libraries.length;
                                self.suppliments.catalogues.items.push(items[i]);
                            }

                            self.suppliments.catalogues.current = self.suppliments.catalogues.items[0];
                        },

                        select (item) {
                            self.suppliments.catalogues.current = item;

                            const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                            let query = {
                                descending: descending?descending:true,
                                page: 1,
                                sort: sortBy?sortBy:'id',
                                take: rowsPerPage?rowsPerPage:10,
                                _token: '{{ csrf_token() }}'
                            };

                            if (item.id) {
                                self.get(self.route(self.urls.library.catalogue, item.id), query);
                            } else {
                                self.get('{{ route('api.library.paginated') }}', query);
                            }
                        }
                    }
                },

                datasetbox () {
                    let self = this
                    return {
                        pagination (pagination) {
                            self.dataset.pagination = pagination;
                            // console.log('paginate', self.dataset.pagination)
                            const { sortBy, descending, page, rowsPerPage } = pagination;
                            // console.log('pagination', self.dataset.pagination);
                            let query = {
                                descending: descending?descending:false,
                                page: page,
                                sort: sortBy?sortBy:'id',
                                take: rowsPerPage,
                                catalogue_id: typeof self.suppliments.catalogues.current.id == 'undefined' ? 0 : self.suppliments.catalogues.current.id
                            };

                            self.get('{{ route('api.library.paginated') }}', query);
                        },

                        sort () {
                            self.dataset.pagination.descending = !self.dataset.pagination.descending;
                            // self.datasetbox().pagination(self.dataset.pagination);
                        },

                        sortBy (header) {
                            if (typeof header.value != 'undefined' && header.value) {
                                let index = self.dataset.headers.findIndex(h => h.value === header.value);
                                self.dataset.pagination.sortBy = self.dataset.headers[index].value;

                                // self.datasetbox().pagination(self.dataset.pagination);
                            }
                        },

                        rowsPerPage (row) {
                            let pagination = {
                                rowsPerPage: typeof row.value != 'undefined' ? row.value : row,
                                rowsPerPageText: typeof row.text != 'undefined' ? row.text : row
                            }
                            self.dataset.pagination = Object.assign(self.dataset.pagination, pagination)
                            console.log('app.rowsPerPage', self.dataset.pagination)
                            // self.datasetbox().pagination(self.dataset.pagination);
                        }
                    }
                },

                searchbox () {
                    let self = this

                    return {
                        close () {
                            self.dataset.searchform.model = !self.dataset.searchform.model

                            if (! self.dataset.searchform.model) {
                                self.supplimentary().select(self.suppliments.catalogues.current);
                            }
                        }
                    }
                },

                dropzonebox () {
                    let self = this
                    return {
                        completed (file) {
                            self.supplimentary().select(self.suppliments.catalogues.current);
                        },

                        sending ({file, xhr, formData}) {
                            self.dropzone.params.extract = self.dropzone.extract;
                            self.dropzone.params.originalname = file.upload.filename;
                            self.dropzone.params.catalogue_id = self.suppliments.catalogues.current.id ? self.suppliments.catalogues.current.id : 0;
                        },
                    }
                }
            },

            mounted () {
                this.get('{{ route('api.library.paginated') }}');
                this.storage();
                this.supplimentary().mount({!! json_encode($catalogues) !!});
            },
        });
    </script>
@endpush

@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12 class="grey--text text--darken-1">
                <v-toolbar card class="transparent">
                    <template v-if="!searchform.model">
                        <v-icon left>archive</v-icon>
                        <v-toolbar-title class="title grey--text text--darken-1">{{ __('Archived') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </template>
                    {{-- Search --}}
                    <template>
                        <template v-if="searchform.model">
                            <v-text-field
                                prepend-icon="search"
                                append-icon="close"
                                :append-icon-cb="() => {searchform.model = !searchform.model; searchform.query = ''}"
                                solo
                                v-model="searchform.query"></v-text-field>
                        </template>
                        <v-btn icon @click="searchform.model = !searchform.model"><v-icon>search</v-icon></v-btn>
                    </template>
                    {{-- /Search --}}

                    <v-btn ripple v-model="bulk.selection.model" icon @click="bulk.selection.model =!bulk.selection.model"><v-icon>check_circle</v-icon></v-btn>
                    {{-- Restore --}}
                    <form action="{{ route('library.many.restore') }}" mthod="POST">
                        {{ csrf_field() }}
                        <input type="hidden" :value="item.id" name="library" v-for="(item, i) in dataset.selected">
                        <v-btn ripple v-tooltip:left="{html: '{{ __('Restore') }}'}" type="submit" icon><v-icon>restore</v-icon></v-btn>
                    </form>
                    {{-- /Restore --}}
                </v-toolbar>
            </v-flex>
        </v-layout>
        <v-layout row wrap>
            <v-flex sm12 class="grey--text text--darken-1">
                <v-progress-circular v-show="!dataset.items.length" indeterminate size="50px"></v-progress-circular>
                <v-dataset
                    card
                    :items="dataset.items"
                    infinite
                    pagination-top
                    @infinite="infinite"
                >
                    <template slot="card" scope="{prop}">
                        <v-card-media v-if="prop.item.thumbnail" :src="prop.item.thumbnail" height="250">
                            <v-layout column wrap>
                                <v-slide-y-transition>
                                    <v-btn icon v-show="bulk.selection.model" @click="prop.selected = !prop.selected">
                                        <v-icon v-if="!prop.selected">check_circle</v-icon>
                                        <v-icon v-else>radio_button_unchecked</v-icon>
                                    </v-btn>
                                </v-slide-y-transition>
                            </v-layout>
                        </v-card-media>
                        <v-toolbar card class="grey lighten-4">
                            <v-toolbar-title class="subheading" v-html="prop.item.name"></v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn icon disabled>
                                <v-icon small v-html="prop.item.icon"></v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-card-actions class="grey--text grey lighten-4">
                            <span class="caption" v-html="prop.item.mimetype"></span>
                            <v-spacer></v-spacer>
                            <span class="caption" v-html="prop.item.filesize"></span>
                        </v-card-actions>
                    </template>
                    <div slot="no-more" v-html="`Total of ${dataset.pagination.totalItems} items found archived.`"></div>
                </v-dataset>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-dataset/dist/vuetify-dataset.min.css') }}">
    {{-- <link rel="stylesheet" href="http://localhost:8080/dist/vuetify-dataset.min.css"> --}}
@endpush

@push('pre-scripts')
    {{-- <script src="http://localhost:8080/dist/vuetify-dataset.min.js"></script> --}}
    <script src="{{ assets('frontier/vuetify-dataset/dist/vuetify-dataset.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        selection: {
                            model: false,
                        },
                    },
                    searchform: {
                        model: false,
                        query: '',
                    },
                    dataset: {
                        headers: [],
                        items: [],
                        selected: [],
                        step: 00,
                        pagination: {
                            rowsPerPage: 5,
                            totalItems: 0,
                        }
                    }
                }
            },
            methods: {
                infinite ($state) {
                    let self = this;

                    setTimeout(function () {
                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        let query = {
                            descending: descending?descending:true,
                            page: self.dataset.step++,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage,
                            _token: '{{ csrf_token() }}',
                            trashedOnly: true,
                        };

                        self.api().get('{{ route('api.library.paginated') }}', query).then(response => {
                            // console.log(response)
                            self.dataset.items = self.dataset.items.concat(response.items.data);
                            self.dataset.pagination.totalItems = response.items.total;

                            $state.loaded()

                            if (self.dataset.pagination.totalItems === self.dataset.items.length) {
                                $state.complete();
                            }
                        });
                    }, 900)

                },

                datasetbox () {
                    let self = this;

                    return {
                        mount (url, query,) {
                            self.api().get(url, query).then(response => {
                                // console.log(response)
                                self.dataset.items = response.items.data;
                                self.dataset.pagination.totalItems = response.items.total;
                            });
                        },
                    }
                }
            },
            mounted () {
                //
            },
            watch: {
                'searchform.query': function (val) {
                    let self = this;
                    setTimeout(function () {
                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        let query = {
                            descending: descending?descending:true,
                            page: page,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage,
                            _token: '{{ csrf_token() }}',
                            trashedOnly: true,
                            q: val,
                        };
                        self.datasetbox().mount('{{ route('api.library.paginated') }}', query);
                    }, 900);
                }
            }
        })
    </script>
@endpush

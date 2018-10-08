@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    {{-- chart --}}
    {{-- @include("Submission::widgets.results") --}}
    {{-- /chart --}}

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md6 xs12>
                <v-card class="elevation-1" height="100%">
                    <v-toolbar dark flat class="secondary">
                        <v-icon left dark>playlist_add_check</v-icon>
                        <v-toolbar-title>{{ __('List of Examinees') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-chip class="primary white--text">{{ $resources->count() }}</v-chip>
                    </v-toolbar>

                    <v-list class="list-container">
                        @foreach ($resources as $resource)
                            <v-list-tile avatar ripple v-bind:ripple="{ class: 'indigo--text text--darken-2' }"
                                href="{{ route('submissions.result', $resource->id) }}" target="_blank">
                                <v-list-tile-avatar>
                                    <img src="{{ $resource->user->avatar }}"/>
                                </v-list-tile-avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ $resource->user->fullname }}</v-list-tile-title>
                                    <v-list-tile-sub-title>{{ __('Scored') }}: {{ $resource->scored }} {{ __('points') }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                                <v-list-tile-action class="pt-3">
                                    <v-list-tile-action-text class="body-1">{{ $resource->created }}</v-list-tile-action-text>
                                    <v-icon></v-icon>
                                </v-list-tile-action>
                            </v-list-tile>
                        @endforeach
                    </v-list>
                </v-card>
            </v-flex>
            <v-flex md6 xs12>
                <v-card class="elevation-1" height="100%">
                    @include("Submission::widgets.statistics")
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .td-n:focus,
        .td-n:hover,
        .td-n:focus:visited {
            text-decoration: none !important;
        }

        .list-container {
            position: relative;
            height: 70vh;
            overflow-y: auto !important;
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
                    resources: {
                        //
                    },
                    bulk: {
                        destroy: {
                            model: false,
                        },
                    },
                    urls: {
                        submissions: {
                            edit: '{{ route('submissions.edit', 'null') }}',
                            show: '{{ route('submissions.show', 'null') }}',
                            destroy: '{{ route('submissions.destroy', 'null') }}',
                        }
                    },
                    dataset: {
                        items: [],
                        resources: [],
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
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                    let query = {
                        descending: descending,
                        page: page,
                        search: filter,
                        sort: sortBy,
                        take: rowsPerPage,
                    };

                    this.api().search('{{ route('api.submissions.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });

                    setTimeout(() => {
                        //
                    }, 400);
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
                    this.api().get('{{ route('api.submissions.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                // this.get();
            }
        });
    </script>

@endpush

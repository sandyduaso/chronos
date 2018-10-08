@extends("Theme::layouts.admin")

@section("head-title", 'Change Password')

@section("content")

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>

                <v-card flat class="mb-3 transparent">
                    <v-list class="transparent">

                        <v-list-tile href="{{ route('users.edit', $resource->id) }}">
                            <v-list-tile-action>
                                <v-icon>account_box</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title
                                    class="body-1"
                                >{{ __('Edit User') }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile href="{{ route('password.change.form', $resource->id) }}">
                            <v-list-tile-action>
                                <v-icon class="primary--text">vpn_key</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title
                                    class="body-1 primary--text"
                                >{{ __('Change Password') }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>

                    </v-list>
                </v-card>

            </v-flex>

            <v-flex sm5 md5>

                @include("Theme::cards.password")

            </v-flex>
        </v-layout>

    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
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
                        required_fields: {
                            model: false,
                        },
                    },
                    urls: {
                        roles: {
                            show: '{{ route('roles.show', 'null') }}',
                            edit: '{{ route('roles.edit', 'null') }}',
                            destroy: '{{ route('roles.destroy', 'null') }}',
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
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
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
                getStorageData() {
                    this.suppliments.required_fields.model = this.getStorage('settings.show_required_fields_only') == 'true';
                },
            },

            mounted () {
                this.getStorageData();
                // this.mountSuppliments();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        });
    </script>
@endpush



@extends("Frontier::layouts.admin")

@section("head-title", __($resource->name))

@section("content")
    @include("Frontier::partials.banner")
    <v-toolbar dark extended class="secondary elevation-0">
        <v-btn
            href="{{ route('grants.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8 xs12 offset-sm2>
                <v-card class="card--flex-toolbar grey--text elevation-1 mb-2">
                    <v-toolbar class="elevation-0 transparent">
                        <v-toolbar-title class="accent--text">{{ __($resource->name) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-menu bottom left>
                            <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                <v-list-tile ripple
                                :href="route(urls.grants.edit, ('{{ $resource->id }}'))">
                                    <v-list-tile-action>
                                        <v-icon accent>edit</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Edit') }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-list-tile ripple
                                    @click="destroy(route(urls.grants.api.destroy, '{{ $resource->id }}'),
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
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Name') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <div class="grey--text text--darken-3">{{ $resource->name }}</div>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Code') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <div class="grey--text text--darken-3">{{ $resource->code }}</div>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Description') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <div class="grey--text text--darken-3">{{ $resource->description }}</div>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Permissions') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                {{-- <template v-for="(permission, i) in permission.item.permissions">
                                    <p>
                                        <strong>@{{ permission.name }}</strong>
                                        <br>
                                        <span>@{{ permission.code }}</span>
                                    </p>
                                </template> --}}
                                <v-list two-line subheader>
                                    <v-list-tile avatar v-for="(permission, i) in permission.item.permissions">
                                        <v-list-tile-avatar>
                                            <v-icon class="green--text text--lighten-2">verified_user</v-icon>
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title>@{{ permission.name }}</v-list-tile-title>
                                            <v-list-tile-sub-title>@{{ permission.code }}</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -80px;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    permission: {
                        item: {!! json_encode($resource) !!},
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
                };
            },
            methods: {
                 destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.grants.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },
            },
            mounted () {
                let self = this;
            }
        })
    </script>
@endpush

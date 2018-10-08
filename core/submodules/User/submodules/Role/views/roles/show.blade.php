@extends("Theme::layouts.admin")

@section("head-title", __($resource->name))

@section("content")
    @include("Frontier::partials.banner")
    <v-toolbar dark extended class="secondary elevation-0">
        <v-btn
            href="{{ route('roles.index') }}"
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
                                <v-list-tile :href="route(urls.roles.edit, ('{{ $resource->id }}'))">
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
                                    @click.native.stop="destroy(route(urls.roles.api.destroy, '{{ $resource->id }}'),
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
                                <div>{{ __('Grants') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <v-expansion-panel popout>
                                    <v-expansion-panel-content v-for="(grant, i) in resource.item.grants" :key="i">
                                        <div slot="header">@{{ grant.name }}</div>
                                        <v-card>
                                            <v-card-text class="pa-0 text-xs-center">
                                                <v-list two-line subheader>
                                                    <v-list-tile avatar v-for="(permission, i) in grant.permissions">
                                                        <v-list-tile-avatar>
                                                            <v-icon class="green--text text--lighten-2">verified_user</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-content>
                                                            <v-list-tile-title>@{{ permission.code }}</v-list-tile-title>
                                                            <v-list-tile-sub-title>@{{ permission.name }}</v-list-tile-sub-title>
                                                        </v-list-tile-content>
                                                    </v-list-tile>
                                                </v-list>
                                            </v-card-text>
                                        </v-card>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
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
                    resource: {
                        item: {!! json_encode($resource) !!},
                        model: false,
                        dialog: {
                            model: false,
                        },
                    },
                    urls: {
                        roles: {
                            api: {
                                clone: '{{ route('api.roles.clone', 'null') }}',
                                destroy: '{{ route('api.roles.destroy', 'null') }}',
                            },
                            show: '{{ route('roles.show', 'null') }}',
                            edit: '{{ route('roles.edit', 'null') }}',
                            destroy: '{{ route('roles.destroy', 'null') }}',
                        },
                    },
                };
            },
            mounted () {
                let self = this;
            }
        })
    </script>
@endpush

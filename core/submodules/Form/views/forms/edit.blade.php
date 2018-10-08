@extends("Frontier::layouts.admin")

@section("head-title", __('Edit Form'))

@section("content")
    @include("Theme::partials.banner")
    <v-toolbar card class="white elevation-1 sticky">
        <v-toolbar-title class="accent--text">{{ __('Edit Form') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        @include("Theme::cards.save")
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <form ref="form" action="{{ route('forms.update', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <v-layout row wrap>
                <v-flex md9>
                    <v-card class="mb-3 elevation-1">
                        <v-card-text>
                            <v-text-field
                                name="name"
                                :error-messages="resource.errors.name"
                                label="{{ __('Title') }}"
                                v-model="resource.item.name"
                                @input="() => { resource.item.code = $options.filters.slugify(resource.item.name); }"
                            ></v-text-field>

                            <input type="hidden" name="code" v-model="resource.item.code">

                            <v-text-field
                                :append-icon-cb="() => (resource.readonly.slug = !resource.readonly.slug)"
                                :append-icon="resource.readonly.slug ? 'fa-lock' : 'fa-unlock'"
                                :readonly="resource.readonly.slug"
                                :value="resource.item.code | slugify"
                                label="{{ __('Code') }}"
                                name="code"
                                persistent-hint
                                :error-messages="resource.errors.code"
                                hint="{{ __("Code is used in generating URL. To customize the code, toggle the lock icon on this field.") }}"
                            ></v-text-field>

                            <v-menu full-width bottom>
                                <v-text-field
                                    append-icon="keyboard_arrow_down"
                                    :error-messages="resource.errors.method"
                                    hint="{{ __('Choose method') }}"
                                    label="{{ __('Method') }}"
                                    name="method"
                                    persistent-hint
                                    slot="activator"
                                    v-model="resource.item.method"
                                ></v-text-field>
                                <v-card>
                                    <v-list>
                                        <v-list-tile ripple @click="resource.item.method = method" :key="i" v-for="(method, i) in misc.methods">
                                            <v-list-tile-content>
                                                <span v-html="method"></span>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </v-menu>
                        </v-card-text>

                        <v-divider></v-divider>

                        {{-- Editor --}}
                        @include("Form::interactive.editor")
                        {{-- /Editor --}}

                        {{-- Edit fields --}}
                        @include("Form::cards.edit-fields")
                        {{-- /Edit fields --}}
                    </v-card>
                </v-flex>

                <v-flex md3>
                    @include("Theme::cards.saving")
                </v-flex>

            </v-layout>
        </form>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    featuredImage: {
                        new: {
                            thumbnail: '{{ $resource->feature }}',
                        },
                        old: [{
                            thumbnail: '{{ $resource->feature }}',
                        }],
                    },
                    resource: {
                        item: {
                            id: '',
                            name: {!! json_encode(old('name') ?? $resource->name) !!},
                            code: '{{ old('code') ?? $resource->code }}',
                            // body: {!! json_encode(old('body') ?? $resource->body) !!},
                            // delta: JSON.parse({!! json_encode(old('delta') ?? $resource->delta) !!}),
                            template: '{{ old('template') ?? $resource->template }}',
                            method: '{{ old('method') ?? $resource->method }}',
                        },
                        quill: {
                            html: {!! json_encode(old('body') ?? $resource->body) !!},
                            delta: JSON.parse({!! json_encode(old('delta') ?? $resource->delta) !!}),
                        },
                        template: '{{ $resource->template }}',
                        errors: {!! json_encode($errors->getMessages()) !!},
                        readonly: {
                            slug: true,
                        },
                        toggle: {
                            parent_id: false,
                        },
                        new: true,
                        misc: {
                            parent: {
                                title: 'None',
                            }
                        }
                    },
                    misc: {
                        methods: [
                            'PUT',
                            'POST',
                        ],
                    },
                }
            },
        })
    </script>
@endpush

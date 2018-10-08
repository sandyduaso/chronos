@extends("Theme::layouts.admin")

@section("head-title", __('Edit Page'))

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar light class="sticky elevation-1 white">
        <v-toolbar-title>{{ __('Edit Page') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        @include("Theme::cards.save")
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <form ref="form" action="{{ route('pages.update', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <v-layout row wrap>
                <v-flex md9 xs12>
                    <v-card class="mb-3 elevation-1">

                        <v-card-text>
                            <v-text-field
                                name="title"
                                :error-messages="resource.errors.title"
                                label="{{ __('Title') }}"
                                v-model="resource.item.title"
                                @input="() => { resource.item.code = $options.filters.slugify(resource.item.title); }"
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
                        </v-card-text>

                        <v-divider></v-divider>

                        {{-- Editor --}}
                        @include("Page::interactive.editor")
                        {{-- /Editor --}}
                    </v-card>
                </v-flex>

                <v-flex md3 xs12>
                    <v-card class="elevation-1">
                        @include("Theme::interactives.featured-image")

                        <v-divider></v-divider>

                        @include("Page::cards.page-attributes")
                    </v-card>
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
                    // featuredImage: {
                    //     new: {
                    //         thumbnail: '{!! $resource->feature !!}',
                    //     },
                    //     old: [{
                    //         thumbnail: '{!! $resource->feature !!}',
                    //     }],
                    // },
                    resource: {
                        item: {
                            title: '{{ $resource->title }}',
                            code: '{{ $resource->code }}',
                            delta: '{!! $resource->delta !!}',
                            body: '{!! $resource->body !!}',
                            template: '{{ $resource->template }}',
                            category_id: '{{ $resource->category_id }}',
                        },
                        quill: {
                            html: {!! json_encode(old('body') ?? $resource->body) !!},
                            delta: JSON.parse({!! json_encode(old('delta') ?? $resource->delta) !!}),
                        },
                        template: '{{ $resource->template }}',
                        category_id: '{!! json_encode($resource->category_id) !!}',
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
                }
            },
        })
    </script>
@endpush

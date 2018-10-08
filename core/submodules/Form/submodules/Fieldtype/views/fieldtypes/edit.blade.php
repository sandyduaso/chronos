@extends("Theme::layouts.admin")

@section("head-title", __('Edit Fieldtype'))
@section("page-title", __('Edit Fieldtype'))

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                {{ __($application->page->title) }}
            </h5>
            {{--  --}}
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    @include('Theme::partials.banner')


    <v-container fluid>
        <v-layout row wrap align-center justify-center>
            <v-flex xs8>
                <v-card class="elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Edit Fieldtype') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <form action="{{ route('fieldtypes.update', $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Title') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-messages="resource.errors.name"
                                        label="Title"
                                        name="name"
                                        value="{{ $resource->name }}"
                                        @input="(val) => { resource.item.name = val; }"
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
                                        hint="{{ __('Will be used as a slug for Fieldtype. Make sure the code is unique.') }}"
                                        label="Code"
                                        name="code"
                                        :value="resource.item.name ? resource.item.name : '{{ $resource->code }}' | slugify"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Template') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-messages="resource.errors.template"
                                        label="Description"
                                        name="template"
                                        value="{{ $resource->template }}"
                                        multi-line
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <div class="text-sm-right">
                                <button type="submit" class="btn btn--raised primary ma-0"><span class="btn__content">{{ __('Update') }}</span></button>
                            </div>
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            template: '',
                            category_id: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },

            mounted () {
                this.get();
                this.mountSuppliments();
                // this.mountSuppliments();
            }
        })
    </script>
@endpush

@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="sticky secondary elevation-1">
        <v-icon left dark>fa-leaf</v-icon>
        <v-toolbar-title>{{ __('Site Branding') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="white">

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex md4 sm6>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm6 md4>


                <v-card flat class="mb-3">
                    <form action="{{ route('settings.branding.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex sm8>
                                    <v-text-field
                                        input-group
                                        label="{{ __('Site Title') }}"
                                        name="site_title"
                                        value="{{ old('site_title') ? old('site_title') : settings('site_title') }}"
                                    ></v-text-field>
                                    <v-text-field
                                        input-group
                                        label="{{ __('Site Tagline') }}"
                                        name="site_tagline"
                                        value="{{ old('site_tagline') ? old('site_tagline') : settings('site_tagline') }}"
                                    ></v-text-field>
                                    <v-text-field
                                        hint="{{ __('The site owner') }}"
                                        input-group
                                        label="{{ __('Site Author') }}"
                                        name="site_author"
                                        persistent-hint
                                        value="{{ old('site_author') ? old('site_author') : settings('site_author') }}"
                                    ></v-text-field>
                                    <v-text-field
                                        input-group
                                        label="{{ __('Site Email Address') }}"
                                        name="site_email"
                                        value="{{ old('site_email') ? old('site_email') : settings('site_email') }}"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex sm4>
                                    <v-card class="transparent elevation-0" role="button" @click="$refs.siteLogoFile.click()">
                                        <v-toolbar dense card class="transparent">
                                            <v-toolbar-title class="caption">{{ __('Site Logo') }}</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-btn icon ripple @click.stop="clearPreview"><v-icon>close</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-avatar tile size="100%">
                                            <img v-if="resource.item.site_logo" :src="resource.item.site_logo" role="button">
                                            <div v-else class="pa-5 grey--text text-xs-center caption">
                                                {{ __('Add a site logo') }}
                                            </div>
                                            <input ref="siteLogoFile" name="site_logo" type="file" class="hidden-sm-and-up" accept=".png,.jpg,image/jpeg,image/png" @change="loadFile">
                                        </v-avatar>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>

                    </form>

                </v-card>

            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        {{-- item: {!! json_encode(@$resource) !!}, --}}
                        item: {
                            site_logo: '{{ (old('site_logo') ? url(old('site_logo')) : null) ?? url(settings('site_logo', 'logo.png')) }}',
                        },
                        radios: {
                            membership: {
                                items: {!! json_encode(config('auth.registration.modes', [])) !!},
                                model: '{{ settings('site_membership', 2) }}',
                            },
                            date_format: {
                                custom: 'm/d/Y',
                                model: '{{ @$resource->date_format ? $resource->date_format : settings('date_format', 'F d, Y') }}'
                            },
                            time_format: {
                                custom: 'H:i:s a',
                                model: '{{ @$resource->time_format ? $resource->time_format : settings('time_format', 'h:i A') }}'
                            }
                        },
                    },

                    file: null,
                    files: [],
                };
            },
            methods: {
                loadFile ($event) {
                    let self = this;
                    let reader = new FileReader();

                    self.files = $event.target.files[0]; //this.$refs.siteLogoFile.file;

                    reader.onloadend = function () {
                        self.resource.item.site_logo = reader.result;
                    }

                    if (self.files) {
                        reader.readAsDataURL(self.files);
                    }
                },
                clearPreview () {
                    this.file = null
                    this.resource.item.site_logo = null;
                }
            }
        });
    </script>
@endpush

@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")

    {{-- @include("Profile::partials.profile-banner") --}}
    <v-toolbar dark class="elevation-1 {{ $resource->detail('backdrop') }}">
    	<v-toolbar-title dark primary-title class="subheading">{{ __('Profile Settings') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg>

        @include("Frontier::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>
            <v-flex sm9 md4>
                <form action="{{ route('profile.emails.update', $resource->id) }}" method="POST">
                	{{ csrf_field() }}
                	{{ method_field('PUT') }}
                    <v-card class="elevation-1 mb-3">
                        <v-card-text>
                            <p class="subheading page-title">{{ __('Email') }}</p>
                            <v-text-field
                                readonly
                                type="email"
                                label="{{ __('Email') }}"
                                hint="{{ __("You cannot change your given email.") }}"
                                v-model="resource.item.email"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-text class="body-1">
                        	<p class="subheading page-title">{{ __('Email preferences') }}</p>
                            <v-checkbox v-model="resource.item.settings.keep_email_private" value="1" label="{{ __('Keep my email address private') }}" hint="{{ __("Unchecking will make your email visible to public and when commenting.") }}" persistent-hint></v-checkbox>
                            <input type="hidden" name="settings[keep_email_private]" :value="resource.item.settings.keep_email_private">
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                    		<v-btn type="submit" primary class="elevation-1">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
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
                        item: {
                            email: '{{ old('email') ?? $resource->email }}',
                            settings: {
                                keep_email_private: '{{ old('keep_email_private') ?? $resource->setting('keep_email_private') }}',
                            },
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },
                }
            },
        });
    </script>
@endpush


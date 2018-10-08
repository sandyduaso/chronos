@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")

    {{-- @include("Profile::partials.profile-banner") --}}
    <v-toolbar dark class="elevation-1 sticky {{ $resource->detail('backdrop') }}">
    	<v-toolbar-title dark primary-title class="subheading">{{ __('Profile Settings') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg>

        @include("Frontier::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>
            <v-flex sm9 md4>
                <form action="{{ route('credentials.update', $resource->id) }}" method="POST">
                	{{ csrf_field() }}
                	{{ method_field('PUT') }}
                    <v-card class="elevation-1 mb-3">
                    	<v-subheader class="subheading page-title">{{ __('Change password') }}</v-subheader>
                    	<v-card-text>
                    		<v-text-field
                    			name="old_password"
                                type="password"
                    			label="{{ __('Old Password') }}"
                    			v-model="resource.item.old_password"
                                :error-messages="resource.errors.old_password"
                    		></v-text-field>
                    		<v-text-field
                    			name="password"
                                type="password"
                    			label="{{ __('New Password') }}"
                    			v-model="resource.item.password"
                                :error-messages="resource.errors.password"
                    		></v-text-field>
                    		<v-text-field
                    			name="password_confirmation"
                                type="password"
                    			label="{{ __('Confirm New Password') }}"
                    			v-model="resource.item.password_confirmation"
                                :error-messages="resource.errors.password_confirmation"
                    		></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                    		<v-btn type="submit" primary class="elevation-1">{{ __('Change Password') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>

                <form action="{{ route('credentials.update', $resource->id) }}" method="POST">
                	{{ csrf_field() }}
                	{{ method_field('PUT') }}
                    <v-card class="elevation-1 mb-3">
                    	<v-subheader class="subheading page-title">{{ __('Change username') }}</v-subheader>
                    	<v-card-text>
                    		<v-text-field
                    			name="username"
                    			label="{{ __('Username') }}"
                    			v-model="resource.item.username"
                    		></v-text-field>
                    	</v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary class="elevation-1">{{ __('Change Username') }}</v-btn>
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
                            username: '{{ old('username') ?? $resource->username }}',
                            old_password: '{{ old('old_password') }}',
                            password: '{{ old('password') }}',
                            password_confirmation: '{{ old('password_confirmation') }}',
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },
                }
            },
        });
    </script>
@endpush


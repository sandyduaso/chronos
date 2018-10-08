@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")

    @include("Profile::partials.profile-banner")

    <v-container fluid grid-list-lg>

        @include("Frontier::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>
            <v-flex sm9 md10>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-card class="elevation-1 mb-3">
                            <v-card-text>
                                <v-subheader class="pl-0">{{ __('Basic Information') }}</v-subheader>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('Full Name') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ $resource->fullname }}
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('Email Address') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ $resource->email }}
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('User Name') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ $resource->username }}
                                    </v-flex>
                                </v-layout>
                                <v-subheader class="pl-0">Other Details</v-subheader>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('Gender') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ $resource->detail('gender') }}
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('Birthday') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ date('F d, Y', strtotime($resource->detail('birthday'))) }}
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('Home Address') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ $resource->detail('home_address') }}
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex xs4 class="grey--text body-1">
                                        {{ __('Phone Number') }}
                                    </v-flex>

                                    <v-flex xs8 class="body-1">
                                        {{ $resource->detail('phone_number') }}
                                    </v-flex>
                                </v-layout>
                            </v-card-text>
                            <v-card-text class="text-xs-right">
                                <v-spacer></v-spacer>
                                @user($resource->id)
                                    <v-btn primary outline href="{{ route('profile.edit', $resource->handlename) }}">{{ __('Edit Profile') }}</v-btn>
                                @enduser
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

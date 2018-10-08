@extends("Theme::layouts.blank")

@section("theme-css")
    <link rel="stylesheet" href="{{ theme("{$resource->code}/css/style.css", true) }}?random={{ date('Y-m-d_H:i:s') }}">
@endsection

@section("pre-content")
    <v-card tile flat class="white elevation-1">
        <v-toolbar primary-title class="subheading">
            <v-toolbar-title primary-title class="subheading">{{ __('Themes Preview: ') }} {{ $resource->name }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn class="accent white--text" href="{{ route('themes.index') }}"><v-icon left>arrow_back</v-icon>{{ __('Back') }}</v-btn>
        </v-toolbar>
    </v-card>
@endsection

@section("content")
    <v-parallax height="280" src="{{ $resource->preview }}">
        <v-container fluid grid-list-lg>
            <v-layout column wrap fill-height>
                <v-spacer></v-spacer>
                <v-flex md4>
                    <v-card tile class="elevation-10">
                        <v-card-media height="140" src="{{ $resource->preview }}"></v-card-media>
                    </v-card>
                </v-flex>
                <v-spacer></v-spacer>
            </v-layout>
        </v-container>
    </v-parallax>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm6>
                <v-card tile class="mb-3 elevation-1">
                    <v-card-actions>
                        <v-avatar size="30px" class="primary"></v-avatar>
                        <div class="caption">{{ __('Primary') }}</div>

                        <v-avatar size="30px" class="accent"></v-avatar>
                        <div class="caption">{{ __('Accent') }}</div>
                    </v-card-actions>
                </v-card>
                <v-card tile class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title primary-title>{{ __('A Sample Card') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-media height="150" src="{{ $resource->preview }}"></v-card-media>
                    <v-card-text class="grey--text text--darken-1">
                        <p class="headline">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p class="subheading">Maxime rerum assumenda natus quibusdam architecto quas, labore voluptatibus cum doloribus cupiditate</p>
                        <ul>
                            <li>
                                <strong>{{ date('H:i:s') }}</strong>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </li>
                            <li>
                                <strong>{{ date('H:i:s') }}</strong>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore molestiae ipsum consequatur, quos quam iste, culpa a ut omnis accusantium architecto fugiat totam optio doloribus nihil consequuntur aperiam dolore asperiores.</p>
                            </li>
                            <li>
                                <strong>{{ date('H:i:s') }}</strong>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos esse perspiciatis, modi adipisci molestias rerum, voluptas officiis sit quo non culpa corporis pariatur earum labore et impedit magnam consectetur veritatis.</p>
                            </li>
                        </ul>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn class="elevation-1 primary white--text">{{ __('Action') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex sm6>
                <v-alert
                    icon="check"
                    class="success"
                    class="mb-4"
                    dismissible
                    transition="slide-y-transition"
                    :value="true"
                >
                    <v-card class="elevation-1 mb--2" style="margin-bottom: -2rem">
                        <v-card-text class="text-xs-center">{!! __("This is a banner was called to notify you that you are <strong>awesome</strong>.") !!} <v-icon class="caption" right>fa-glass</v-icon></v-card-text>
                    </v-card>
                </v-alert>
                <v-card class="mt-4">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title primary-title>{{ __('Components') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field label="{{ __('Normal') }}"></v-text-field>
                        <v-text-field label="{{ __('Email') }}" suffix="@gmail.com"></v-text-field>
                        <v-text-field type="password" label="{{ __('Password') }}" append-icon="lock"></v-text-field>
                        <v-text-field label="{{ __('How much?') }}" prefix="$"></v-text-field>
                        <v-text-field label="{{ __('Field') }} 4" prepend-icon="edit"></v-text-field>
                        <v-text-field label="{{ __('Field') }} 5" prepend-icon="insert_drive_file"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn class="elevation-1 success white--text">{{ __('Success') }}</v-btn>
                        <v-btn class="elevation-1 info white--text">{{ __('Info') }}</v-btn>
                        <v-btn class="elevation-1 warning white--text">{{ __('Warning') }}</v-btn>
                        <v-btn class="elevation-1 error white--text">{{ __('Error') }}</v-btn>
                        <v-btn class="elevation-1 accent white--text">{{ __('Accent') }}</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex sm6>
                <v-card dark class="blue accent-2 elevation-1">
                    <v-toolbar card dark class="transparent">
                        <v-toolbar-title primary-title>{{ __('Todo') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-list>
                        <v-list-tile ripple @click="">
                            <v-list-tile-avatar>
                                <v-icon>credit_card</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>{{ __('Billing Statements') }}</v-list-tile-content>
                            <v-icon>keyboard_arrow_right</v-icon>
                        </v-list-tile>
                        <v-list-tile ripple @click="">
                            <v-list-tile-avatar>
                                <v-icon>settings_input_component</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>{{ __('Make more components') }}</v-list-tile-content>
                            <v-icon>keyboard_arrow_right</v-icon>
                        </v-list-tile>
                        <v-list-tile ripple @click="">
                            <v-list-tile-avatar>
                                <v-icon>directions_walk</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>{{ __('Excercise?') }}</v-list-tile-content>
                            <v-icon>keyboard_arrow_right</v-icon>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

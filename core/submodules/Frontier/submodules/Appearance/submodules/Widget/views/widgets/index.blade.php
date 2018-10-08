@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="secondary elevation-1 sticky">
        <v-icon dark left>widgets</v-icon>
        <v-toolbar-title>{{ __('Widgets') }}</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm4>

                @include("Widget::cards.widgets")

            </v-flex>
            <v-flex sm8>

                <v-card class="mb-3 elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="subheading">{{ __('Available Widgets') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-list>
                        @foreach ($widgets as $widget)
                            <v-list-tile ripple target="_blank" href="{{ route('widgets.edit', $widget->id) }}">
                                <v-list-tile-avatar>
                                    <v-icon>{{ $widget->icon }}</v-icon>
                                </v-list-tile-avatar>
                                <v-list-tile-title>{{ $widget->name }}</v-list-tile-title>
                                <v-list-tile-action>
                                    <v-chip>{{ $widget->roles->count() }}</v-chip>
                                </v-list-tile-action>
                            </v-list-tile>
                        @endforeach
                    </v-list>
                </v-card>

            </v-flex>
        </v-layout>
    </v-container>
@endsection

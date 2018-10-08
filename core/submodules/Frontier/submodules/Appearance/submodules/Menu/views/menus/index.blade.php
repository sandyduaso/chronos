@extends("Theme::layouts.admin")

@section("head-title", __('Menus'))

@section("content")
    <v-toolbar dark class="secondary elevation-1 sticky">
        <v-icon dark left>menu</v-icon>
        <v-toolbar-title class="subheading">{{ __('Menus') }}</v-toolbar-title>
    </v-toolbar>
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="elevation-1">
                    <v-list three-line>
                        @foreach ($locations as $location)
                        <v-list-tile ripple target="_blank" href="{{ route('menus.edit', $location->code) }}">
                            @if ($location->icon)
                                <v-list-tile-avatar>
                                    <v-icon>{{ $location->icon }}</v-icon>
                                </v-list-tile-avatar>
                            @endif
                            <v-list-tile-content>
                                <v-list-tile-title class="subheading">
                                    {{ $location->name }}
                                    <span class="caption grey--texy">({{ $location->code }})</span>
                                </v-list-tile-title>
                                <div class="grey--text caption">{{ $location->count }} {{ __('items') }}</div>
                                <em class="caption grey--text">{{ $location->description }}</em>
                            </v-list-tile-content>
                            <v-list-tile-actions>
                                <v-icon>keyboard_arrow_right</v-icon>
                            </v-list-tile-actions>
                        </v-list-tile>
                        @endforeach
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

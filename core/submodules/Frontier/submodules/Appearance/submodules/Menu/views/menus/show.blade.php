@extends("Theme::layouts.admin")

@section("head-title", __('Menus'))

@section("content")
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex lg12>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="subheading">{{ $resource->name }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="grey lighten-4">
                        <p class="subheading grey--text text--darken-2"><v-icon left>search</v-icon><span>{{ __('Preview') }}</span></p>
                        <v-toolbar dark class="primary elevation-1">
                            @include("Template::recursives.{$resource->code}", ['items' => $resource->items])
                        </v-toolbar>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn success class="elevation-1" flat href="{{ route('menus.edit', $resource->code) }}">{{ __('Edit') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

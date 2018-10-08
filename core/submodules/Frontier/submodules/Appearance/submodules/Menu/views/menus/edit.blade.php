@extends("Theme::layouts.admin")

@section("head-title", __("Edit") . " {$location->name}")

@section("content")
    <v-toolbar dense dark class="secondary elevation-0">
        <v-toolbar-title class="subheading">{{ __($location->name) }}</v-toolbar-title>
    </v-toolbar>


    @include("Page::interactive.pages", ['items' => $menus])
@endsection

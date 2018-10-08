{{--
Template Name: Single Template
Description: The default single template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

@extends("Template::layouts.public")

@section("content")
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8>
                <h4 class="grey--text text--darken-1">{{ $page->title }}</h4>
                <v-card class="elevation-1">
                    <v-card-text>
                        {!! $page->body !!}
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

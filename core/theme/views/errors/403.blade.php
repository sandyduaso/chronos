@extends("Theme::layouts.public")

@section("head-title", '403 Error')
@section("head-subtitle", 'Forbidden')

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm6 offset-sm3 class="text-xs-center">
                <h1 class="page-title display-5 mt-5 mb-0 blue-grey--text text--lighten-4"><strong>{{ __('403') }}</strong></h1>
                <h2 class="page-title display-2 mt-0 lh-1 blue-grey--text text--lighten-3">{{ __('Forbidden') }}</h2>
                <p class="subheading page-title blue-grey--text text--lighten-3">{{ __('The action previously taken or this part of the application is restricted.') }}
                </p>

                {{-- <v-card-text>
                    <v-btn primary round large class="px-4 elevation-1" href="\admin/dashboard">Dashboard</v-btn>
                </v-card-text> --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection

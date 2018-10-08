{{--
Template Name: About Template
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

@extends("Template::layouts.public")

@section("content")
{{-- <v-card class="elevation-0">
    <v-parallax class="elevation-1" src="{{ $page->feature }}" height="400"></v-parallax>

    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="elevation-1">
                    <v-card-title primary-title class="headline">{{ $page->title }}</v-card-title>
                    <v-card-text>
                        {!! $page->body !!}
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

    {{ __('Our website is currently under construction. We should be back shortly. Thank you for your patience.') }}
<v-card> --}}

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <img class="404" src="{{ assets('frontier/images/placeholder/maintenance.png') }}" style="width: 80%;" alt="">
            </div>
            <p><strong> {{ __('Our website is currently under construction. We should be back shortly. Thank you for your patience.') }}</strong></p>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
        html, body {
            background-color: #fff !important;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        a {
            color: #f68d61;
        }
        .application--light {
            background: #fff !important;
        }
    </style>
@endpush

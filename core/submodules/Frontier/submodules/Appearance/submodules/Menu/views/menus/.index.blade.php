<div class="card">
                  <div id="menus-options-accordion" class="accordion bg-workspace">
                    {{-- Pages --}}
                    <div class="accordion-item">
                      <div role="button" class="accordion-header p-3 d-flex justify-content-between" data-toggle="collapse" data-target="#accordion-item-page" aria-expanded="false" aria-controls="accordion-item-page">{{ __('Pages') }} <i class="mdi mdi-chevron-down"></i></div>
                      <div id="accordion-item-page" class="collapse p-3" aria-labelledby="headingOne" data-parent="#menus-options-accordion">
                        @foreach ($pages as $page)
                          <div class="card border-bottom">
                            <div class="card-body">
                              <div class="lead"><strong>{{ $page['title'] }}</strong></div>
                              <em>url://{{ $page['code'] }}</em>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    {{-- Pages --}}

                    {{-- Social --}}
                    <div class="accordion-item">
                      <div role="button" class="accordion-header p-3 d-flex justify-content-between" data-toggle="collapse" data-target="#accordion-item-social" aria-expanded="false" aria-controls="accordion-item-social">{{ __('Social') }} <i class="mdi mdi-chevron-down"></i></div>
                      <div id="accordion-item-social" class="collapse p-3" aria-labelledby="headingOne" data-parent="#menus-options-accordion">
                        @foreach ($pages as $social)
                          <div class="card border-bottom">
                            <div class="card-body">
                              <div class="lead"><strong>{{ $social['title'] }}</strong></div>
                              <em>url://{{ $social['code'] }}</em>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    {{-- Social --}}

                    {{-- Links --}}
                    <div class="accordion-item">
                      <div role="button" class="accordion-header p-3 d-flex justify-content-between" data-toggle="collapse" data-target="#accordion-item-link" aria-expanded="false" aria-controls="accordion-item-link">{{ __('Links') }} <i class="mdi mdi-chevron-down"></i></div>
                      <div id="accordion-item-link" class="collapse p-3" aria-labelledby="headingOne" data-parent="#menus-options-accordion">
                        @foreach ($pages as $link)
                          <div class="card border-bottom">
                            <div class="card-body">
                              <div class="lead"><strong>{{ $link['title'] }}</strong></div>
                              <em>url://{{ $link['code'] }}</em>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    {{-- Links --}}
                  </div>
                </div>

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

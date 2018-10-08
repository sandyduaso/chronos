@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="secondary elevation-1 sticky">
        <v-icon dark left>format_paint</v-icon>
        <v-toolbar-title>{{ __('Themes Settings') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        @include("Theme::forms.theme-upload")
    </v-toolbar>

    <v-card tile class="elevation-1">
        <v-card-media class="primary" height="180" src="{{ $active->preview }}">
            <v-layout column wrap flex-end fill-height>
                <v-flex sm12 fill-height>
                    <v-card flat dark class="transparent">
                        <v-card-title primary-title>
                            <h3 class="headline">
                                {{ $active->name }}
                            </h3>
                            <v-spacer></v-spacer>
                        </v-card-title>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-card-media>
        <v-card-text class="grey--text text--darken-1 subheading">
            <div class="caption mb-3">
                <strong>{{ __("Author: ") }}</strong>{{ $active->author->name }}
                @if ($active->author->email)
                    <em>({{ $active->author->email }})</em>
                @endif
            </div>
            {!! $active->description !!}
        </v-card-text>
        <v-card-actions>
            <v-chip label class="secondary white--text"><v-icon left>format_paint</v-icon>{{ __('currently applied as the site theme') }}</v-chip>
            <v-spacer></v-spacer>
            @if (settings('active_theme', 'default') !== settings('default_theme', 'default'))
                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="active_theme" value="{{ settings('default_theme', 'default') }}">
                    <v-btn v-tooltip:left="{html: `{{ __("This will revert the theme back to Pluma's Default theme") }}`}" type="submit" flat class="success--text elevation-1">{{ __('Restore Default Theme') }}</v-btn>
                </form>
            @endif
        </v-card-actions>
    </v-card>

    <v-container fluid grid-list-lg class="grey lighten-4">
        <v-layout row wrap>
            <v-flex xs12>
                @include("Theme::partials.banner")

                <v-layout row wrap fill-height>
                    <v-toolbar flat class="transparent">
                        <v-toolbar-title class="grey--text text--darken-1">{{ __('Installed Themes') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        {{-- @include("Setting::forms.theme-upload") --}}
                    </v-toolbar>

                    @foreach ($resources as $resource)
                    <v-flex md4 sm6 fill-height>
                        <form action="{{ route('settings.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="active_theme" value="{{ $resource->code }}">
                            <input type="hidden" name="site_timestamp" value="{{ date('YmdHis') }}">
                            <v-card class="mb-3 elevation-1">
                                <v-card-media src="{{ $resource->preview }}" class="secondary" height="200px">
                                    <v-layout column wrap flex-end fill-height>
                                        <v-flex sm12 fill-height>
                                            <v-card flat dark class="transparent">
                                                <v-card-title primary-title>
                                                    <h3 class="headline">{{ $resource->name }}</h3>
                                                    <v-spacer></v-spacer>
                                                    @if ($resource->timestamp >= date(strtotime('1 day ago')))
                                                        <v-chip label class="blue white--text">{{ __('NEW') }}</v-chip>
                                                    @endif
                                                </v-card-title>
                                                <v-card-text class="subheading">
                                                    {{ $resource->description }}
                                                </v-card-text>
                                            </v-card>
                                        </v-flex>
                                    </v-layout>
                                </v-card-media>
                                <v-card-actions>
                                    {{-- @click.native.stop="loadPreview('{{ json_encode($resource) }}')" --}}
                                    {{-- <v-btn ripple href="{{ route('themes.destroy', $resource->code) }}" class="error white--text elevation-1">{{ __('Delete') }}</v-btn> --}}

                                    <v-btn ripple href="{{ route('themes.preview', $resource->code) }}" flat class="grey elevation-1"><v-icon left>search</v-icon>{{ __('Preview') }}</v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn type="submit" flat primary class="elevation-1"><v-icon left>format_paint</v-icon>{{ __('Apply') }}</v-btn>
                                </v-card-actions>
                            </v-card>
                        </form>
                    </v-flex>
                    @endforeach

                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>

@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    preview: {
                        item: {},
                        model: false,
                    }
                }
            },
            methods: {
                loadPreview (item) {
                    this.preview.model = !this.preview.model;
                    this.preview.item = JSON.parse(item);
                }
            }
        });
    </script>
@endpush

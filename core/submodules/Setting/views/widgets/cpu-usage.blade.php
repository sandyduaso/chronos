@viewable('cpu-usage')
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-card class="elevation-1 mb-3 draggable-widget">
            <v-card-media height="150px" src="{{ assets('frontier/images/placeholder/s3.png') }}">
                {{-- <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                <v-toolbar card class="sortable-handle transparent white--text">
                    {{-- <v-icon left>{{ widgets('cpu-usage')->icon }}</v-icon> --}}
                    <v-toolbar-title class="title"><strong>{{ __(widgets('cpu-usage')->name) }}</strong></v-toolbar-title>
                </v-toolbar>
            </v-card-media>
            <v-card-text class="pa-5 grey--text text--lighten-1 text-xs-center">
                <div>
                </div>
                <div><em>No current data available.</em></div>
            </v-card-text>
        </v-card>
    </draggable>
@endviewable

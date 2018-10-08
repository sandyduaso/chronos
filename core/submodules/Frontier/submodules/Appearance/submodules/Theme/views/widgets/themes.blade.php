@viewable('themes')
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
        >
        <v-card class="elevation-1 draggable-widget mb-3">
            <v-card-media height="150px" class="sortable-handle" src="{{ get_active_theme()->preview }}">
                <v-card class="elevation-0 transparent">
                    <v-card-text class="title white--text">
                        <strong>{{ get_active_theme()->name }}</strong>
                    </v-card-text>
                </v-card>
            </v-card-media>
            <v-card-text>
                <div class="mb-2 uppercase">{{ __('Theme:') }}  <strong>{{ get_active_theme()->name }}</strong></div>
            </v-card-text>
            <v-card-actions class="mx-2">
                <div class="mb-2 grey--text caption"><em>{{ __('currently applied as the site theme') }}</em></div>
                <v-spacer></v-spacer>
                <v-btn primary flat class="mb-2 elevation-1" href="{{ route('themes.index') }}">{{ __('Change') }}</v-btn>
            </v-card-actions>
        </v-card>
    </draggable>
@endviewable

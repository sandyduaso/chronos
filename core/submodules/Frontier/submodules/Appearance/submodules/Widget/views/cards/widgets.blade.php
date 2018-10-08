<form action="{{ route('widgets.refresh') }}" method="POST">
    {{ csrf_field() }}
    <v-card class="elevation-1 mb-3">
        <v-toolbar card class="transparent">
            <v-toolbar-title class="subheading">{{ __("Widgets") }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="grey--text text--lighten-1 body-1">
            <p class="body-1">{{ __("Widgets are dynamic cards conveying easy to digest data.") }}</p>
            <p class="body-1">{{ __("Refreshing will install widgets specified by the modules installed.") }}</p>
        </v-card-text>
        <v-card-actions class="pa-3">
            <v-spacer></v-spacer>
            <v-btn type="submit" primary class="elevation-1">{{ __('Refresh') }}</v-btn>
        </v-card-actions>
    </v-card>
</form>

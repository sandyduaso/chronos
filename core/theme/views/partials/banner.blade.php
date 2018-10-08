@if (Session::has("type"))
    <v-alert
        {{-- :hide-icon="true" --}}
        icon="{{ Session::has("type") == 'success' ? 'check' : 'priority_high' }}"
        class="{{ Session::get("type") }} mb-4"
        dismissible
        transition="slide-y-transition"
        v-model="alert.model"
        :mode="alert.mode"
        timeout="{{ Session::has("timeout") ? Session::get("timeout") : 2000 }}"
        value="{{ Session::has("type") ? true : false }}"
    >
        <v-card style="margin-bottom: -2rem" class="elevation-1 mb--2">
            {{-- @if (Session::has('title'))
                <v-card-title class="text-xs-center pb-0">{{ __(Session::get('title')) }}</v-card-title>
            @endif --}}
            @if (Session::has('message'))
                <v-card-text class="text-xs-center">{{ __(Session::get('message')) }}</v-card-text>
            @endif
        </v-card>
    </v-alert>
@else
    <template v-if="snackbar">
        <v-alert
            {{-- :hide-icon="true" --}}
            :icon="snackbar.context == 'success' ? 'check' : 'priority_high'"
            :class="snackbar.context"
            class="mb-4"
            dismissible
            transition="slide-y-transition"
            v-model="snackbar.model"
            :mode="snackbar.mode"
            :value="snackbar.model"
            :timeout="snackbar.timeout"
        >
            <v-card style="margin-bottom: -2rem" class="elevation-1 mb--2">
                <v-card-text v-if="snackbar.text" class="text-xs-center">@{{ snackbar.text }}</v-card-text>
            </v-card>
        </v-alert>
    </template>
@endif


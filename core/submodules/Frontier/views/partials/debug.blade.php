@if (config('debugging.debug'))
    <v-alert class="ma-0" warning v-show="'true'">
        {{ __('Application is running APP_DEBUG ON.') }}
        <a class="white--text" href="{{ route('settings.system.configuration') }}">{{ __('Change settings.') }}</a>
    </v-alert>
@endif

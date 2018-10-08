<v-toolbar dark flat class="accent">
    <a href="{{ url('/') }}">
        <v-avatar tile>
            <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
        </v-avatar>
    </a>

    <v-toolbar-title class="subheading white--text">
        <div href="{{ url('/') }}">{{ $application->site->title }}</div>
        <div class="caption">{{ $application->site->tagline }}</div>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <v-toolbar-items>
        @include("Template::recursives.main-menu", ['items' => get_menu('main-menu')])

        @if (settings('show_login_at_main_menu', true))
            <v-btn flat primary href="{{ route('login.show') }}">{{ __(user() ? 'Dashboard' : 'Login') }}</v-btn>
        @endif
    </v-toolbar-items>
</v-toolbar>

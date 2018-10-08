@yield("pre-utilitybar")

<v-toolbar
    :class="theme.utilitybar"
    class="elevation-3 grey--text"
    fixed
    {{-- app --}}
    {{-- scroll-off-screen --}}
    :dark.sync="light" :light.sync="dark"
>
    <v-toolbar-side-icon class="grey--text" @click.stop="setStorage('sidebar.drawer', (sidebar.drawer = !sidebar.drawer))">
        {{-- <v-icon :dark.sync="dark" :light.sync="light">@{{ sidebar.drawer?'chevron_left':'chevron_right' }}</v-icon> --}}
    </v-toolbar-side-icon>

    @stack("page-title")
    @yield("page-title")

    <v-spacer></v-spacer>

    @stack("utilitybar")

    @section("utilitybar-menu")
        {{-- <v-menu offset-y origin="bottom right" min-width="180px">
            <v-list-tile-title slot="activator" flat :dark.sync="dark" :light.sync="light">
                {{ $application->greet or __("Hello, ") . user()->displayname }}
            </v-list-tile-title>
            <v-list>
                <v-list-tile href="{{ '#' }}">
                    <v-list-tile-action>
                        <v-icon>account_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>{{ __('Profile') }}</v-list-tile-title>
                </v-list-tile>

                <v-divider></v-divider>
                <v-list-tile href="{{ route('logout.logout') }}">
                    <v-list-tile-action>
                        <v-icon>backspace</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>{{ __('Logout') }}</v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu> --}}
    @show

    {{-- <v-text-field
        class="elevation-0"
        solo
        prepend-icon="search"
        append-icon="keyboard_voice"
    >

    </v-text-field> --}}

    <v-btn icon class="grey--text" @click.native.stop="rightsidebar.model = !rightsidebar.model">
        <v-icon :dark.sync="light" :light.sync="dark">chevron_left</v-icon>
    </v-btn icon>
</v-toolbar>

@stack("post-utilitybar")

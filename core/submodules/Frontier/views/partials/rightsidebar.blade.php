<v-navigation-drawer
    temporary
    right
    v-model="rightsidebar.model"
    overflow
>
    <v-toolbar flat class="transparent">
        <v-list class="pa-0">
            <v-list-tile tag="div">
                <v-list-tile-content>
                    <v-list-tile-title :dark.sync="light" :light.sync="dark">{{ __('Quick Settings') }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn
                        icon
                        @click.native.stop="rightsidebar.model = !rightsidebar.model"
                    >
                        <v-icon>chevron_right</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-toolbar>

    <v-divider :dark.sync="light" :light.sync="dark"></v-divider>

    @stack('pre-rightsidebar')

    <v-toolbar flat class="transparent">
        <v-list dense>
            {{-- Page Specific settings --}}
            <v-subheader
                :dark.sync="light" :light.sync="dark"
                class="text--lighten-1"
                v-if="page.model"
            >
                {{ __('Page Settings') }}
            </v-subheader>
            @stack("page-settings")
            {{-- /Page Specific settings --}}

            <v-divider></v-divider>

            <v-subheader
                :dark.sync="light" :light.sync="dark"
                class="text--lighten-1"
            >
                <span>{{ __('Theme') }}</span>
                <v-spacer></v-spacer>
                <v-icon :dark.sync="light" :light.sync="dark">style</v-icon>
            </v-subheader>
            <v-layout row class="pa-1">
                <v-flex xs12>
                    <v-card class="elevation-0">
                        <v-card-text>
                            <div class="text-xs-left">
                                <span>{{ __('Font size') }}: @{{ `${settings.fontsize.model}px` }}</span>
                                <v-btn icon title="{{ __('Reset font size')  }}" @click.native="setStorage('settings.fontsize', (settings.fontsize.model = settings.fontsize.default))"><v-icon>refresh</v-icon></v-btn>
                                <br>
                                <small class="grey--text">{{ __('Font size affects all body of texts like articles, paragraphs, quotes found within the app.') }}</small>
                                <p class="ma-0" :style="`font-size: ${settings.fontsize.model}px`"><em>Sample Text</em></p>
                            </div>
                            <v-slider
                                role="button"
                                v-model="settings.fontsize.model"
                                thumb-label
                                v-on:input="setStorage('settings.fontsize', settings.fontsize.model)"
                                v-bind:min="10"
                                v-bind:max="76"
                            ></v-slider>
                        </v-card-text>
                        <v-card-text>
                            <div class="text-xs-left">
                                <span>{{ __('Main Sidebar') }}</span>
                            </div>
                            <v-switch v-bind:label="`Extend Utilitybar`" v-on:change="setStorage('sidebar.floating', sidebar.floating)" v-model="sidebar.floating"></v-switch>
                            <v-switch v-bind:label="`Mini sidebar`" v-on:change="setStorage('sidebar.mini', sidebar.mini)" v-model="sidebar.mini"></v-switch>
                        </v-card-text>

                        <v-card-text>
                            @include("Theme::partials.widget")
                        </v-card-text>

                        {{-- Color Scheme --}}
                        {{-- <v-card-text>
                            <div class="text-xs-left">
                                <span>{{ __('Color') }}</span>
                            </div>
                        </v-card-text>
                        <v-container fluid grid-list-lg>
                            <v-layout row wrap>
                                <v-flex
                                    xs4
                                    v-for="thm in theme.colors.items"
                                    :key="thm"
                                >
                                    <v-card flat tile>
                                        <v-btn
                                            @click.native="theme.avatar = thm.value"
                                            role="button"
                                            :style="`background-color: ${thm.preview};
                                                width: 100%; height:40px;
                                                border: 1px solid gray`"
                                        ></v-btn>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container> --}}
                        {{-- /Color Scheme --}}
                    </v-card>
                </v-flex>
            </v-layout>

            <v-subheader
                :dark.sync="light" :light.sync="dark"
                class="text--lighten-1"
            >
                <span>{{ __('Local Storage') }}</span>
                <v-spacer></v-spacer>
                <v-icon :dark.sync="light" :light.sync="dark">save</v-icon>
            </v-subheader>
            <v-list-tile
                @click="showDialog({
                    {{-- icon: 'delete', --}}
                    title: '{{ __("Reset Application Settings") }}',
                    description: '{{ __("You are about to reset settings for Sidebar Mode, Theme, and any other features settings stored on your Local Storage. This will revert all user interface in its default state. Proceed?") }}',
                    confirmHandler: () => { clearStorage() },
                })">
                <v-list-tile-action>
                    <v-icon>delete</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>{{ __("Reset Application Settings") }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-toolbar>

</v-navigation-drawer>

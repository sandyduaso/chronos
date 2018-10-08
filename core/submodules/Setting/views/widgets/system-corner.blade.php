@viewable('system-corner')
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card v-show="!removesystemcorner" transition="slide-y-transition" class="elevation-1 mb-3 draggable-widget">
                <v-card-media height="150px" src="{{ assets('frontier/images/placeholder/storage-1.png') }}">
                     <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                    <v-toolbar dark card class="transparent sortable-handle">
                        {{-- <v-icon dark>{{ widgets('system-corner')->icon }}</v-icon> --}}
                        <v-toolbar-title class="title"><strong>{{ widgets('system-corner')->name }}</strong></v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-menu bottom left>
                            <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                           <v-list>
                                <v-list-tile @click="removesystemcorner = !removesystemcorner" ripple>
                                    <v-list-tile-action>
                                        <v-icon error class="error--text">remove_circle</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Remove') }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-list-tile @click="setStorage('widget.hidesystemcorner', (hidesystemcorner = !hidesystemcorner))" ripple>
                                    <v-list-tile-action>
                                        <v-icon class="grey--text">@{{ hidesystemcorner ? 'visibility' : 'visibility_off' }}</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            @{{ hidesystemcorner ? 'Show' : 'Hide' }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </v-list>
                        </v-menu>
                    </v-toolbar>
                </v-card-media>

                <v-card-text class="pa-0" v-show="!hidesystemcorner">
                    <v-list three-line>
                        <v-subheader class="purple--text text--lighten-1">{{ __('Server Environment') }}</v-subheader>
                        <v-list-tile avatar>
                            <v-list-tile-avatar tile>
                                <img src="{{ assets('frontier/images/placeholder/systems/admin.png') }}" alt="">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ __('Server Admin') }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ @$_SERVER['SERVER_ADMIN'] }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-avatar tile>
                                <img src="{{ assets('frontier/images/placeholder/systems/2.png') }}" alt="">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ __('Server Software') }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ $_SERVER['SERVER_SOFTWARE'] }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-avatar tile>
                                <img src="{{ assets('frontier/images/placeholder/systems/1.png') }}" alt="">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ __('Document Root') }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ $_SERVER['DOCUMENT_ROOT'] }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-avatar tile>
                                <img src="{{ assets('frontier/images/placeholder/systems/5.png') }}" alt="">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ __('Remote Address') }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ $_SERVER['REMOTE_ADDR'] }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-avatar tile>
                                <img src="{{ assets('frontier/images/placeholder/systems/4.png') }}" alt="">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>{{ __('Server Signature') }}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ $_SERVER['SERVER_SIGNATURE'] }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card-text>
                <v-card-actions v-show="!hidesystemcorner">
                    <v-spacer></v-spacer>
                    <v-btn flat primary href="{{ route('settings.system') }}">{{ __('View More') }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removesystemcorner: this.getStorage('widgets.removesystemcorner') === "true",
                        hidesystemcorner: this.getStorage('widgets.hidesystemcorner') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable

@viewable('profile')
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card v-show="!removeprofile" transition="slide-y-transition" class="elevation-1 mb-3 draggable-widget">
                <v-card-media height="100px" class="{{ user()->detail('backdrop', 'accent lighten-1') }}">
                    <v-toolbar card dark class="sortable-handle transparent white--text">
                        <v-spacer></v-spacer>
                        <v-menu bottom left>
                                <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                               <v-list>
                                    <v-list-tile @click="removeprofile = !removeprofile" ripple>
                                        <v-list-tile-action>
                                            <v-icon error class="error--text">remove_circle</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                {{ __('Remove') }}
                                            </v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile @click="setStorage('widget.hideprofile', (hideprofile = !hideprofile))" ripple>
                                        <v-list-tile-action>
                                            <v-icon class="grey--text">@{{ hideprofile ? 'visibility' : 'visibility_off' }}</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                @{{ hideprofile ? 'Show' : 'Hide' }}
                                            </v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-menu>
                    </v-toolbar>
                </v-card-media>
                <v-card v-show="!hideprofile" flat class="card--flex-avatar transparent text-xs-center">
                    <v-avatar size="80px">
                        <img src="{{ user()->avatar }}" alt="">
                    </v-avatar>
                </v-card>
                <v-card-text class="text-xs-center" v-show="!hideprofile">
                    <div><strong>{{ user()->fullname }}</strong></div>
                    <div class="body-1 grey--text darken-1">{{ user()->displayrole }}</div>
                    <v-card-text class="body-1">
                        <div>{{ user()->detail('gender') }}</div>
                        <div>{{ user()->detail('birthday') }}</div>
                        <div>{{ user()->email }}</div>
                    </v-card-text>
                    <v-btn outline round href="profile/{{ user()->username }}" class="{{ user()->detail('backdrop', 'accent lighten-1') }}">Edit profile</v-btn>
                </v-card-text>
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('css')
        <style>
            .card--flex-avatar {
                margin-top: -40px;
            }
        </style>
    @endpush

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removeprofile: this.getStorage('widgets.removeprofile') === "true",
                        hideprofile: this.getStorage('widgets.hideprofile') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable

<div class="mb-3">
<v-layout row wrap>
    <v-flex md3 sm6 xs12>
        <v-card v-ripple class="elevation-4 text-xs-center">
            <v-card-media class="white--text" style="background: linear-gradient(45deg, rgb(2, 136, 209) 0%, rgb(38, 198, 218) 100%);">
                {{-- <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                <v-layout column>
                    <v-card dark class="text-xs-center elevation-0 transparent">
                        <v-card-text>
                            <v-card-actions class="pa-0">
                                <v-avatar size="60px" class="elevation-5 light-blue darken-2">
                                    <img src="{{ assets('frontier/images/placeholder/glance-module.png') }}">
                                </v-avatar>
                                <v-spacer></v-spacer>
                                <div class="display-2 countup" data-target="{{ count(get_modules_path()) }}">0</div>
                            </v-card-actions>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <div class="subheading">{{ __('Modules') }}</div>
                            </v-card-actions>
                            <v-card-actions class="mb-2">
                                <v-spacer></v-spacer>
                                <v-btn dark outline small round class="py-3" href="{{ route('settings.system') }}">{{ __('Manage Modules') }}</v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-layout>
            </v-card-media>
        </v-card>
    </v-flex>

    <v-flex md3 sm6 xs12>
        <v-card v-ripple class="elevation-4 text-xs-center">
            <v-card-media class="white--text" style="background: linear-gradient(45deg, #9C27B0 0%, #f48fb1 100%);">
                {{-- <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                <v-layout column>
                    <v-card dark class="text-xs-center elevation-0 transparent">
                        <v-card-text>
                            <v-card-actions class="pa-0">
                                <v-avatar size="60px" class="elevation-5 light-blue darken-2">
                                    <img src="{{ assets('frontier/images/placeholder/glance-permission-1.png') }}">
                                </v-avatar>
                                <v-spacer></v-spacer>
                                <div class="display-2 countup" data-target="glance.visualizations.permissions.total" v-html="glance.visualizations.permissions.total"></div>
                            </v-card-actions>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <div class="subheading">{{ __('Permissions') }}</div>
                            </v-card-actions>
                            <v-card-actions class="mb-2">
                                <v-spacer></v-spacer>
                                <v-btn dark outline small round class="py-3" href="{{ route('permissions.index') }}">{{ __('Check Permissions') }}</v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-layout>
            </v-card-media>
        </v-card>
    </v-flex>

    <v-flex md3 sm6 xs12>
        <v-card v-ripple class="elevation-4 text-xs-center">
            <v-card-media class="white--text" style="background: linear-gradient(45deg, #E91E63 0%, #FF9800 100%);">
                {{-- <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                <v-layout column>
                    <v-card dark class="text-xs-center elevation-0 transparent">
                        <v-card-text>
                            <v-card-actions class="pa-0">
                                <v-avatar size="60px" class="elevation-5 light-blue darken-2">
                                    <img src="{{ assets('frontier/images/placeholder/glance-page.png') }}">
                                </v-avatar>
                                <v-spacer></v-spacer>
                                <div class="display-2 countup" data-target="glance.visualizations.pages.total" v-html="glance.visualizations.pages.total"></div>
                            </v-card-actions>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <div class="subheading">{{ __('Pages') }}</div>
                            </v-card-actions>
                            <v-card-actions class="mb-2">
                                <v-spacer></v-spacer>
                                <v-btn dark outline small round class="py-3" href="{{ route('pages.index') }}">{{ __('Add New') }}</v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-layout>
            </v-card-media>
        </v-card>
    </v-flex>

    <v-flex md3 sm6 xs12>
        <v-card v-ripple class="elevation-4 text-xs-center">
            <v-card-media class="white--text" style="background: linear-gradient(45deg, #673AB7 0%, rgb(98, 174, 206) 100%);">
            {{-- <v-card-media class="white--text" style="background: linear-gradient(45deg, #1176af 0%, rgb(98, 174, 206) 100%);"> --}}
                {{-- <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                    <v-layout column>
                        <v-card dark class="text-xs-center elevation-0 transparent">
                            <v-card-text>
                                <v-card-actions class="pa-0">
                                    <v-avatar size="60px" class="elevation-5 cyan darken-3">
                                        <img src="{{ assets('frontier/images/placeholder/glance-user-1.png') }}">
                                    </v-avatar>
                                    <v-spacer></v-spacer>
                                    <div class="display-2 countup" data-target="glance.visualizations.users.total" v-html="glance.visualizations.users.total"></div>
                                </v-card-actions>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <div class="subheading">{{ __('Users') }}</div>
                                </v-card-actions>
                                <v-card-actions class="mb-2">
                                    <v-spacer></v-spacer>
                                    <v-btn dark outline small round class="py-3" href="{{ route('users.index') }}">{{ __('View Users') }}</v-btn>
                                </v-card-actions>
                            </v-card-text>
                        </v-card>
                    </v-layout>
            </v-card-media>
        </v-card>
    </v-flex>
</v-layout>
</div>

@push('pre-scripts')
    <script src="{{ assets('frontier/js/countup.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    glance: {
                        visualizations: {
                            users: {
                                items: [],
                                total: 0,
                            },
                            pages: {
                                items: [],
                                total: 0,
                            },
                            permissions: {
                                items: [],
                                total: 0,
                            },
                        },
                    },
                };
            },

            methods: {
                getVisualizations () {
                    let self = this;
                    let query = {
                        take: '-1',
                    };

                    self.api().get('{{ route('api.users.all') }}', query).then(response => {
                        self.glance.visualizations.users.items = response.items.data;
                        self.glance.visualizations.users.total = response.items.total;
                    });

                    setTimeout(function () {
                        self.api().get('{{ route('api.pages.all') }}', query).then(response => {
                            self.glance.visualizations.pages.items = response.items.data;
                            self.glance.visualizations.pages.total = response.items.total;
                        });
                    }, 800);

                    setTimeout(function () {
                        self.api().get('{{ route('api.permissions.all') }}', query).then(response => {
                            self.glance.visualizations.permissions.items = response.items.data;
                            self.glance.visualizations.permissions.total = response.items.total;
                        });
                    }, 1200);

                    setTimeout(function () {
                        document.querySelectorAll('.countup').forEach(item => {
                            // alert(item.getAttribute('data-target'));
                            var counter = new CountUp(item, 0, item.getAttribute('data-target'));

                            if (! counter.error) {
                                counter.start();
                            }
                        });
                    }, 1600);
                }
            },

            mounted () {
                this.getVisualizations();
            }
        })
    </script>
@endpush

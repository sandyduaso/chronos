<v-bottom-sheet v-model="widget.sheet">
    <v-btn slot="activator" primary flat>
        <v-icon left>widgets</v-icon> {{ __('Manage widgets') }}</v-btn>
    <v-list>
        {{-- remove widgets --}}
        <v-subheader>{{ __('Remove Widgets') }}</v-subheader>
        <v-list-tile
            v-for="tile in removewidgets"
            :key="tile.title"
            class="mb-3"
            >
            <v-list-tile-action>
                <v-btn icon v-tooltip:right="{ html: 'Remove Widget' }"><v-icon error>remove_circle</v-icon></v-btn>
            </v-list-tile-action>
            <v-list-tile-avatar>
                <v-avatar size="40px">
                    <img :src="tile.img" :alt="tile.title">
                </v-avatar>
            </v-list-tile-avatar>
            <v-list-tile-title v-html="tile.title"></v-list-tile-title>
        </v-list-tile>
        {{-- /remove widgets --}}

        {{-- add widgets --}}
        <v-subheader>{{ __('Add Widgets') }}</v-subheader>
        <v-list-tile
            v-for="tile in addwidgets"
            :key="tile.title"
            >
            <v-list-tile-action>
                <v-btn icon v-tooltip:right="{ html: 'Add Widget' }"><v-icon success>add_circle</v-icon></v-btn>
            </v-list-tile-action>
            <v-list-tile-avatar>
                <v-avatar size="40px">
                    <img :src="tile.img" :alt="tile.title">
                </v-avatar>
            </v-list-tile-avatar>
            <v-list-tile-title v-html="tile.title"></v-list-tile-title>
        </v-list-tile>
        {{-- /add widgets --}}
    </v-list>
</v-bottom-sheet>

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data() {
                return {
                    widget: {
                        sheet: false,
                    },
                    addwidgets: [
                        {
                            img: '{{ assets('frontier/images/placeholder/s2.png') }}',
                            title: 'Keep'
                        },
                        {
                            img: '{{ assets('frontier/images/placeholder/s1.png') }}',
                            title: 'Inbox'
                        },
                    ],
                    removewidgets: [
                        {
                            img: '{{ assets('frontier/images/placeholder/s2.png') }}',
                            title: 'sdddfdfsdsd'
                        },
                        {
                            img: '{{ assets('frontier/images/placeholder/s1.png') }}',
                            title: 'sdsdsd'
                        },
                    ]
                }
            }
        })
    </script>
@endpush

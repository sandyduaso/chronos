<v-mediabox search :multiple="false" close-on-click :categories="mediabox.catalogues" v-model="content.mediabox" :old="content.resource.interactive ? content.resource.interactive : []" @selected="value => { content.resource.interactive = value }">
    <template slot="media" scope="props">
        <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
            {{-- <span v-html="props"></span> --}}
            <v-card-media height="250px" :src="props.item.thumbnail">
                <v-container fill-height class="pa-0 white--text">
                    <v-layout fill-height wrap column>
                        <v-card-title class="subheading" v-html="props.item.originalname"></v-card-title>
                        <v-slide-y-transition>
                            <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                        </v-slide-y-transition>
                        <v-spacer></v-spacer>
                        <v-card-actions class="px-2 white--text">
                            <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                            <v-spacer></v-spacer>
                            <span v-html="props.item.mime"></span>
                            <span v-html="props.item.filesize"></span>
                        </v-card-actions>
                    </v-layout>
                </v-container>
            </v-card-media>
        </v-card>
    </template>
</v-mediabox>

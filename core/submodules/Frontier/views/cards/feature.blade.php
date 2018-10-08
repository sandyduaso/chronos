{{-- <v-card class="mb-3 elevation-1"> --}}
    <v-toolbar card dense class="transparent">
        <v-icon left>add_a_photo</v-icon>
        <v-toolbar-title class="subheading body-2 accent--text">{{ __('Featured Image') }}</v-toolbar-title>
    </v-toolbar>

    <v-mediabox
        :categories="resource.feature.catalogues"
        :multiple="false"
        :old="resource.item.feature ? [resource.item.feature] : []"
        close-on-click
        search="mime:image"
        toolbar-icon="perm_media"
        toolbar-label="{{ __('Featured Image') }}"
        v-model="resource.feature.model"
        dropzone
        auto-remove-files
        :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
        :dropzone-params="{_token: '{{ csrf_token() }}'}"
        @selected="value => { resource.item.feature = value[0] }"
        @category-change="val => resource.feature.current = val"
        @sending="({file, params}) => { params.catalogue_id = resource.feature.current.id; params.originalname = file.upload.filename}"
    >
        <template slot="dropzone">
            <span class="caption">{{ __('Uploads will be catalogued as ') }}<em>@{{ resource.feature.current ? resource.feature.current.name : 'Uncategorized' }}</em></span>
            {{-- <v-card-text>
                <span v-if="resource.feature.current" v-html="`Currently uploading ${resource.feature.current}`"></span>
            </v-card-text> --}}
        </template>
        <template slot="media" scope="props">
            <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
                <v-card-media height="150px" :src="props.item.thumbnail">
                    <v-container fill-height class="pa-0 white--text">
                        <v-layout fill-height wrap column>
                            <v-spacer></v-spacer>
                            <v-slide-y-transition>
                                <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                            </v-slide-y-transition>
                            <v-spacer></v-spacer>
                        </v-layout>
                    </v-container>
                </v-card-media>
                <v-card-title primary-title class="subheading white--text" v-html="props.item.originalname"></v-card-title>
                <v-card-actions class="px-2 white--text">
                    <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                    <span v-html="props.item.mimetype"></span>
                    <v-spacer></v-spacer>
                    <span v-html="props.item.mime"></span>
                    <span v-html="props.item.filesize"></span>
                </v-card-actions>
            </v-card>
        </template>
    </v-mediabox>

    <v-card-text v-if="!Object.keys(resource.item.feature?resource.item.feature:{}).length" class="text-xs-center">
        <v-fade-transition>
            <div v-show="!resource.item.feature" class="my-2 text-xs-center">
                <v-icon x-large class="grey--text text--lighten-2">perm_media</v-icon>
                <p class="ma-0 caption grey--text text--lighten-2">{{ __('No Image') }}</p>
            </div>
        </v-fade-transition>
    </v-card-text>

    <div v-else class="pa-2">
        <img
            width="100%"
            height="auto"
            :src="resource.item.feature ? resource.item.feature.thumbnail : ''"
            role="button"
            @click.stop="resource.feature.model = !resource.feature.model"
        >
    </div>
    <input type="hidden" name="feature_obj" :value="JSON.stringify(resource.item.feature)">
    <input type="hidden" name="feature" :value="resource.item.feature ? resource.item.feature.thumbnail : ''">
    {{-- <v-card-media
        v-else
        :src="resource.item.feature ? resource.item.feature.thumbnail : ''"
        height="280px"
        role="button"
        @click.stop="resource.feature.model = !resource.feature.model">
        <v-container fill-height fluid class="pa-0 white--text">
            <v-layout column>
                <v-card-title class="pa-0 subheading">
                    <v-spacer></v-spacer>
                    <v-btn dark icon @click.stop="resource.item.feature = null"><v-icon>close</v-icon></v-btn>

                    <input type="hidden" name="feature_obj" :value="JSON.stringify(resource.item.feature)">
                    <input type="hidden" name="feature" :value="resource.item.feature ? resource.item.feature.thumbnail : ''">
                </v-card-title>
            </v-layout>
        </v-container>
    </v-card-media> --}}

    <v-card-actions>
        <v-btn v-if="resource.item.feature" flat @click.stop="resource.item.feature = null">{{ __('Remove') }}</v-btn>
        <v-spacer></v-spacer>
        <v-btn flat @click.stop="resource.feature.model = !resource.feature.model"><span v-html="resource.item.feature ? '{{ __('Change') }}' : '{{ __('Browse') }}'"></span></v-btn>
    </v-card-actions>
{{-- </v-card> --}}

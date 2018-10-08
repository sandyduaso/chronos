<v-mediabox
    :categories="featuredImage.categories"
    :dropzone="true"
    :dropzone-options="{url:'{{ route('api.profile.upload.upload', $resource->id) }}', autoProcessQueue: true}"
    :dropzone-params="{_token: '{{ csrf_token() }}'}"
    :multiple="false"
    :old="featuredImage.old"
    auto-remove-files
    close-on-click
    search="mime:image"
    toolbar-icon="perm_media"
    toolbar-label="{{ __('Featured Image') }}"
    v-model="featuredImage.model"
    @selected="value => { featuredImage.new = value[0] }"
    @sending="({file, params}) => { params.upload_type = '{{ $type ?? 'avatar' }}'; params.originalname = file.upload.filename}"
>
    <template slot="media" scope="props">
        <v-card transition="scale-transition" class="white" :class="props.item.active?'elevation-10':'elevation-1'">
            <v-toolbar dense card class="transparent">
                <v-toolbar-title class="subheading" v-html="props.item.originalname"></v-toolbar-title>
            </v-toolbar>
            <v-card-media height="250px" :src="props.item.thumbnail">
                <v-container fill-height class="pa-0 white--text">
                    <v-layout fill-height wrap column>
                        <v-spacer></v-spacer>
                        <v-slide-y-transition>
                            <v-icon ripple class="display-4 pa-1 text-xs-center primary--text text-elevation-10" v-show="props.item.active">check</v-icon>
                        </v-slide-y-transition>
                        <v-spacer></v-spacer>
                    </v-layout>
                </v-container>
            </v-card-media>
            <v-card-actions class="grey--text">
                <v-icon class="grey--text" v-html="props.item.icon"></v-icon>
                <v-spacer></v-spacer>
                <span v-html="props.item.mime"></span>
                <span v-html="props.item.filesize"></span>
            </v-card-actions>
        </v-card>
    </template>
</v-mediabox>

<div v-else>
    <img
        width="100%"
        :src="featuredImage.new ? featuredImage.new.thumbnail : ''"
        role="button"
        @click.stop="featuredImage.model = !featuredImage.model"
    >
</div>

<input type="hidden" name="feature_obj" :value="JSON.stringify([featuredImage.new])">
<input type="hidden" name="feature" :value="featuredImage.new ? featuredImage.new.thumbnail : ''">
<v-card-actions>
    <v-btn v-if="featuredImage.new" flat @click.stop="featuredImage.new = null">{{ __('Remove') }}</v-btn>
    <v-spacer></v-spacer>
</v-card-actions>
</v-card>


@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    featuredImage: {
                        categories: [
                            {
                                'count': null,
                                'name': '{{ __('My Uploads') }}',
                                'icon': 'perm_media',
                                'url': '{{ route('api.profile.upload.all') }}'
                            }
                        ],
                        current: null,
                        new: {
                            thumbnail: '{{ old('feature') ?? @$resource->feature }}',
                        },
                        old: [{
                            thumbnail: '{{ old('feature') ?? @$resource->feature }}',
                        }],
                        category: {
                            current: {},
                        },
                        model: false,
                    }
                }
            },

            mounted () {
                this.featuredImage.categories = {!! json_encode($catalogues) !!};
                this.featuredImage.old = '{!! old('feature_obj') !!}' ? JSON.parse('{!! old('feature_obj') !!}') : [{thumbnail: '{{ @$resource->feature }}'}];
            },
        })
    </script>
@endpush

{{-- Editor --}}
<v-quill class="elevation-0" source :upload-params="{_token: '{{ csrf_token() }}', 'return': 1}" :options="{uploadUrl: '{{ route('api.library.upload') }}', placeholder: '{{ __('Write something...') }}'}" v-model="resource.quill" class="mb-3 card--flat white elevation-1" :fonts="mediabox.fonts" @toggle-mediabox="() => { mediabox.model = ! mediabox.model }" :mediabox.sync="mediabox.url">
    <template>
        <input type="hidden" name="body" :value="resource.quill.html">
        <input type="hidden" name="delta" :value="JSON.stringify(resource.quill.delta)">
    </template>
</v-quill>
{{-- /Editor --}}

<v-mediabox
    dropzone
    :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
    :dropzone-params="{_token: '{{ csrf_token() }}'}"
    :multiple="false" close-on-click v-model="mediabox.model" @selected="value => { mediabox.resource = value[0]; mediabox.url = value[0]?value[0].thumbnail:'' }">
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

@push('css')
    {{-- <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    {{-- <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script> --}}
    {{-- <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script> --}}
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        // Vue.use(VueResource);
        mixins.push({
            data () {
                return {
                    resource: {
                        quill: {
                            html: '{!! old('body') !!}',
                            delta: JSON.parse({!! json_encode(old('delta')) !!}),
                        }
                    },
                    mediabox: {
                        model: false,
                        fonts: {!! json_encode(config('editor.fonts.enabled', [])) !!},
                        url: '',
                        resource: {
                            thumbnail: '',
                        },
                    },
                }
            },
        })
    </script>
@endpush

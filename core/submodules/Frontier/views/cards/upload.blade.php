<v-card class='elevation-1'>
    <v-toolbar card dense class="transparent">
        <v-toolbar-title>{{ __('Upload Files') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click.native="bulk.upload.model = false"><v-icon>close</v-icon></v-btn>
    </v-toolbar>
    <v-card-text>
        {{-- Dropzone --}}
        <dropzone parallel-uploads="-1" url="{{ route('api.library.upload') }}" :upload-multiple="true" :params="{_token: '{{ csrf_token() }}'}" :auto-process-queue="false" v-on:thumbnail="thumbnail" v-on:addedfile="addedfile" v-on:complete="complete" v-on:success="success" v-on:uploadprogress="uploadprogress">
            <template slot="preview-template">
                <v-card raised class="dz-preview dz-file-preview ma-2 grey lighten-2">
                    <span class="dz-progressbar success" data-dz-uploadprogress></span>
                    <div>
                        <v-btn role="button" icon data-dz-remove small class="closebutton elevation-2 warning white--text"><v-icon>close</v-icon></v-btn>
                    </div>
                    <div class="dz-success-mark"><v-icon x-large class="success--text">check_circle</v-icon></div>
                    <div class="dz-error-mark"><v-icon x-large class="error--text">error</v-icon></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>

                    <div class="dz-thumbnail-container">
                        <img data-dz-thumbnail width="100%" height="200px">
                    </div>
                    <div class="card--dz-details">
                        <v-card-text class="white--text">
                            <span class="subheading" data-dz-name></span>
                        </v-card-text>
                        <v-card-actions card dense class="white--text">
                            <span class="caption pink pa-2" data-dz-type></span>
                            <v-spacer></v-spacer>
                            <span class="caption blue pa-2" data-dz-size></span>
                        </v-card-actions>
                    </div>
                </v-card>
            </template>
        </dropzone>
        {{-- /Dropzone --}}
    </v-card-text>
</v-card>

@push('post-css')
    <link rel="stylesheet" href="{{ assets('frontier/dist/dropzone/Dropzone.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/dist/dropzone/Dropzone.js') }}"></script>
    <script>
        Vue.use(Dropzone);

        mixins.push({
            components: {Dropzone},

            data () {
                return {
                    resources: {
                        items: [],
                    },
                    template: '',
                    resource: {
                        dropzone: {
                            file: null,
                            name: '',
                            type: '',
                            items: [],
                            progress: {
                                model: 0,
                            }
                        },
                    },
                };
            },

            watch: {
                'resource.dropzone.name': function (val) {
                    console.log('watch',val);
                }
            },

            methods: {
                addedfile (file, preview, dropzone) {
                    console.log("addedfile", file.dataURL, dropzone.files);
                    this.resource.dropzone.items = dropzone.files;
                },

                complete (file, dropzone) {
                    // console.log(file, 'upload completed');
                },

                success (file, response, dropzone) {
                    console.log(response, 'successfull upload');
                },

                uploadprogress (file, progress, preview, dropzone) {
                    //
                },

                thumbnail (file, dataURL, preview, dropzone) {
                    // preview.querySelector('[data-dz-thumbnail]').setAttribute('src', 'http://icons.veryicon.com/png/Application/Long%20Shadow%20Media/Sound%20Music.png');
                }
            },

            mounted () {
                //
            }
        });
    </script>
@endpush


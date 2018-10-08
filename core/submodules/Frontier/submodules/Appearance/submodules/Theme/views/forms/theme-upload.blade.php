<v-dialog>
    <v-btn slot="activator" class="success elevation-1">{{ __('Upload Theme') }}</v-btn>
    <form action="{{ route('themes.upload') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <v-card class="elevation-1">
            <v-toolbar card class="transparent">
                <v-toolbar-title>{{ __('Upload Theme') }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text class="grey lighten-4 grey--text text--lighten-1 text-xs-center pa-4">
                <div role="button" @click="$refs.fileInput.click()">
                    <v-icon class="grey--text text--lighten-1 display-3">file_upload</v-icon>
                    <div class="caption">{{ __('Click to browse') }}</div>
                </div>
                <div class="caption">
                    <input
                    accept="zip,rar,7z,application/zip,application/rar,application/7z"
                        class="hidden-lg-and-down" ref="fileInput" type="file"
                        name="theme"
                        @change="f => (file.name = f.target.files[0].name)"
                    >
                    <span v-html="file.name"></span>
                </div>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn :disabled="!file.name" type="submit" class="primary">{{ __('Submit') }}</v-btn>
            </v-card-actions>
        </v-card>
    </form>
</v-dialog>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    file: {
                        model: null,
                        name: '',
                    }
                }
            }
        })
    </script>
@endpush

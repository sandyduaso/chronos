<v-card class="elevation-1 mb-3">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="subheading accent--text">{{ __('Form Template') }}</v-toolbar-title>
    </v-toolbar>

    {{-- template --}}
    <v-card-text>
        <v-select v-model="resource.item.template" item-value="value" item-text="name" label="{{ __('Form Template') }}" :items="attributes.templates"></v-select>
        <input type="hidden" name="template" :value="resource.item.template">
    </v-card-text>
    {{-- template --}}
</v-card>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    attributes: {
                        templates: {!! json_encode($templates) !!},
                    },
                }
            },
        });
    </script>
@endpush
